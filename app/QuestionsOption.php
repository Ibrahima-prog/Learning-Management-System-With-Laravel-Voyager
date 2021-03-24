<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class QuestionsOption extends Model
{
    public function scopeActive($query)
    {

        $todayquestion= new Question();
        $k[]=null;
        foreach ($todayquestion->active()->get() as $qvalue) {
            # code...
            $k[]=$qvalue->options()->get()->all();
            if ($k) {
                # code...
                foreach ($k as $kvalue) {
                    # code...

                    if ($kvalue) {
                        # code...
                        foreach ($kvalue as $qvalue) {
                            # code...
                            $qr[]=$qvalue->id;
                        }
                    }

                }
            }
        }
        return $query->whereIn('id',$qr);


    }
    public function question()
    {
        return $this->belongsToMany('App\Question','App\PivotQuestionsOption');
    }
}
