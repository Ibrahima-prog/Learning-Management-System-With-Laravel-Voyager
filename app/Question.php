<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    public function scopeActive($query)
{


    $todaytest=new Test();$k[]=null;$mr[]=null;
        foreach ($todaytest->active()->get() as $value) {
            # code...
            if ($value->questions()->get()->all()!=null) {
                # code...
                $k[]=$value->questions()->get()->all();
                foreach ($k as  $kvalue) {
                    # code...
                    if ($kvalue) {
                        # code...
                        foreach ($kvalue as  $mrvalue) {
                            # code...
                            $mr[]=$mrvalue->id;
                        }
                    }

                }
            }

        }
    return $query->whereIn('id',$mr);


}
    public function delete()
    {
        // delete all related photos
        $this->options()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
public function options()
    {
        return $this->belongsToMany('App\QuestionsOption','App\PivotQuestionsOption');
    }
    public function test()
    {
        return $this->belongsToMany('App\Test','App\TestsQuestion');
    }
}
