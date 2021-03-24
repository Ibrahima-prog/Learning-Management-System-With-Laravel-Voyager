<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\CoursesLesson;
use App\Lesson;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
class UsersCoursesController extends Controller
{
    public function show($course_slug)
    {

        $course=Course::where('slug',$course_slug)->firstorFail();
        $courselesson=CoursesLesson::where('course_id',$course->id)->get()->pluck('lesson_id');
        $lessons=Lesson::whereIn('id',$courselesson)->orderBy('position','ASC')->get();
        //dd($lesson);
        $purchased_course=\Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
        return view('courses', compact('course','lessons','purchased_course'));
        //, 'purchased_course'
       if(!$course){
         return   abort(404);
        }
    }
    public function payment(Request $request)
    {
        $course = Course::findOrFail($request->get('course_id'));
        $this->createStripeCharge($request);

        $course->students()->attach(\Auth::id());

        return redirect()->back()->with('success', 'Payment completed successfully.');
    }
    private function createStripeCharge($request)
    {
        Stripe::setApiKey(env('STRIPE_API_KEY'));

        try {
            $customer = Customer::create([
                'email' => $request->get('stripeEmail'),
                'source'  => $request->get('stripeToken')
            ]);

            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->get('amount'),
                'currency' => "usd"
            ]);
        } catch (\Stripe\Error\Base $e) {
            return redirect()->back()->withError($e->getMessage())->send();
        }
    }
    public function rating($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $course->students()->updateExistingPivot(\Auth::id(), ['rating' => $request->get('rating')]);

        return redirect()->back()->with('success', 'Thank you for rating.');
    }
}
