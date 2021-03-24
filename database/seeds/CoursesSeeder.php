<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 5)->create()
        ->each(function($course){
            $course->lessons()
            ->saveMany(factory(App\Lesson::class,5)
            ->create()
            ->each(function($lesson){
                $lesson->test()
                ->saveMany(factory(App\Test::class,1)
                ->create()
                ->each(function($test){
                    $test->questions()
                    ->saveMany(factory(App\Question::class,5)
                    ->create()
                    ->each(function($question){
                        $question->options()
                        ->saveMany(factory(App\QuestionsOption::class,4)
                        ->make());
                }));

            }));
            }));
        });
        foreach (Course::all() as $course) {
            $course->users()->sync([1]);
        }
        }
}
