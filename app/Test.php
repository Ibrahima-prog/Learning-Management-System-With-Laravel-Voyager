<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
    public function scopeActive($query)
    {
        $todaytest=new Lesson();$k[]=null;
        foreach ($todaytest->active()->get() as $value) {
            # code...
            if ($value->test()->first()!=null) {
                # code...
                $k[]=$value->test()->first()->id;
            }

        }
        return $query->whereIn('id',$k);
    }
    public function delete()
    {
        // delete all related photos
        $this->questions()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
    public function questions()
    {
        return $this->belongsToMany('App\Question','App\TestsQuestion');
    }
    public function lessons()
    {
        return $this->belongsToMany('App\Lesson','App\TestLesson');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Course','App\TestCourse');
    }
}
