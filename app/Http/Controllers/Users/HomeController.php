<?php

namespace App\Http\Controllers\Users;

use App\Course;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    Public function index(){
        $purchased_courses = NULL;
        if (\Auth::check()) {
            $purchased_courses = Course::whereHas('students', function($query) {
                $query->where('id', \Auth::id());
            })
            ->with('lessons')
            ->orderBy('id', 'desc')
            ->get();
        }
        //dd($purchased_courses);
        $courses=Course::orderBy('id','desc')->get();
        return view ('index',compact('courses','purchased_courses'));
    }
}
