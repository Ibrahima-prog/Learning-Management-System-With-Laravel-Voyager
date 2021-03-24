<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Lesson extends Model
{

    public function scopeActive($query)
    {
        $courses=new Course();
        $courselesson=new CoursesLesson();
         //  dd($courselesson->where('lesson_id',1)->get()->pluck('course_id'));
        //   dd(course::active()->get()->pluck('id'));
        $CourseId= $courselesson->whereIn('course_id',$courses::active()
        ->get()->pluck('id'))->get()
        ->pluck('course_id');

        $tests=$courselesson->whereIn('course_id', $CourseId)->get()
            ->pluck('lesson_id');
        if (Auth::user()->role_id!=1 ) {

                return $query->whereIn('id', $tests);
        }
    }
    public function delete()
    {
        // delete all related photos
        $this->test()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
    public function scopeActive2($query)
    {
        $courses=new Course();
        $courselesson=new CoursesLesson();
         //  dd($courselesson->where('lesson_id',1)->get()->pluck('course_id'));
        //   dd(course::active()->get()->pluck('id'));
         $CourseId= $courselesson->whereIn('course_id',$courses::active()->get()->pluck('id'))->get()->pluck('course_id');

        $tests=$courselesson->whereIn('course_id', $CourseId)->get()
            ->pluck('lesson_id');
        if (Auth::user()->role_id!=1 ) {

            return $query->whereIn('id', $tests);
        }
    }
    //
    public function course() {
        return $this->belongsToMany('App\Course','App\CoursesLesson');
    }
    public function test() {
        return $this->belongsToMany('App\Test','App\TestLesson');
    }
    public function students()
    {
        return $this->belongsToMany('App\User', 'lesson_students')->withTimestamps();
    }
}
