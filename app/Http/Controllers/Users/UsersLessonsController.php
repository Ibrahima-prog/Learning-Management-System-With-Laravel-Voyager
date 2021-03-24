<?php

namespace App\Http\Controllers\Users;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\CoursesLesson;
use App\TestLesson;
use App\Lesson;
use App\Question;
use App\PivotQuestionsOption;
use App\QuestionsOption;
use App\TestsResult;

class UsersLessonsController extends Controller
{
    public function show($course_id,  $lesson_slug)
    {

    //dd($lesson_slug);
        $lesson=Lesson::where('slug',$lesson_slug)->firstorFail(); //dd($lesson->course->first()->id);
       /* if (\Auth::check())
        {
            if ($lesson->students()->where('id', \Auth::id())->count() == 0) {
                $lesson->students()->attach(\Auth::id());
            }
        }*/

        $courselesson=CoursesLesson::where('lesson_id',$lesson->id)->get()->pluck('course_id');
        $TheCourse=Course::where('id',$courselesson)->first();
        $purchased_course=$TheCourse->students()->where('user_id', \Auth::id())->count() > 0;
        $courselesson2=CoursesLesson::where('course_id',$courselesson)->get()->pluck('lesson_id');
        $publishedLessons=Lesson::whereIn('id',$courselesson2)
        ->where('published',1)->get();
        $test_result = NULL;
        if ($lesson->test) {
            $test_result = TestsResult::where('test_id', $lesson->test->first()->id)
                ->where('user_id', \Auth::id())
                ->first();
        }
        $previous_lesson=Lesson::whereIn('id',$courselesson2)
        ->where('published',1)
        ->where('position','<',$lesson->position)
        ->orderBy('position','desc')
        ->first();
        $next_lesson=Lesson::whereIn('id',$courselesson2)
        ->where('published',1)
        ->where('position','>',$lesson->position)
        ->orderBy('position','asc')
        ->first();
       $test_exists=$lesson->test->first() ;
       //dd($test_exists->questions->first()->options);
        //dd($test_exists->title);
       // $lessons=Lesson::whereIn('id',$courselesson)->orderBy('position','ASC')->get();
        //dd($TheCourse);
        $test_exists=FALSE;
        if ($lesson->test->first() && $lesson->test->first()->questions->count()>0) {
            # code...
            $test_exists=TRUE;
        }
        return view('lessons', compact('lesson','previous_lesson','next_lesson','publishedLessons','TheCourse','test_exists',
        'test_result','purchased_course'));
        //, 'purchased_course'
       if(!$lesson){
         return   abort(404);
        }
    }
    public function test($lesson_slug, Request $request)
    {
        $lesson = Lesson::where('slug', $lesson_slug)->firstOrFail();
        $answers = [];
        $test_score = 0;
        foreach ($request->get('questions') as $question_id => $answer_id) {
            $question =Question::find($question_id);

           // $option_id = PivotQuestionsOption::where('question_id', $question_id);
            $correct=QuestionsOption::where('id',$answer_id)

                ->where('correct', 1)->count() > 0;
               // dd($correct);
            $answers[] = [
                'question_id' => $question_id,
                'option_id' => $answer_id,
                'correct' => $correct
            ];
            if ($correct) {
                $test_score += $question->score;
            }
            //dd($answers);
            /*
             * Save the answer
             * Check if it is correct and then add points
             * Save all test result and show the points
             */
        }
        //dd(Auth::id());
        $test_result = TestsResult::create([
            'test_id' => $lesson->test->first()->id,
            'user_id' => Auth::id(),
            'test_result' => $test_score
        ]);
        $test_result->answers()->createMany($answers);

        return redirect()->route('lessons.show', [$lesson->course->first()->id, $lesson_slug])->with('message', 'Test score: ' . $test_score);
    }

}
