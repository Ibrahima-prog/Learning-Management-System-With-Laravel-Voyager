<?php

use Illuminate\Database\Seeder;

class CoursesLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\CoursesLesson::class, 25)->create();

    }
}
