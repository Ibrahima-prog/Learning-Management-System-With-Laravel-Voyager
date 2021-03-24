<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Course extends Model
{

    public function scopeActive($query)
    {
        $tests=DB::table('user_course')->whereIn('user_id',[Auth::user()->id])->get()->pluck("course_id");
        if(Auth::user()->role_id!=1){

        return $query->whereIn('id', $tests);
        };

    }
    public function scopeActive2($query)
    {
        $tests=DB::table('user_course')->whereIn('user_id',[Auth::user()->id])->get()->pluck("course_id");
        if(Auth::user()->role_id!=1){

        return $query->whereIn('id', $tests);
        };

    }
    public function delete()
    {
        // delete all related photos
        $this->lessons()->delete();
       // $this->lessons->test()->delete();
     //   $this->lessons->test->questions()->delete();
        //$this->lessons->test->questions->options()->delete();

        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
    public function test() {
        return $this->belongsToMany('App\Test','App\TestCourse');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'App\UserCourse')->withTimestamps();
    }
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'App\CoursesLesson')->withTimestamps();
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student')->withTimestamps()->withPivot(['rating']);
    }
    public function getRatingAttribute()
    {
        return number_format(\DB::table('course_student')->where('course_id', $this->attributes['id'])->average('rating'), 2);
    }
}
