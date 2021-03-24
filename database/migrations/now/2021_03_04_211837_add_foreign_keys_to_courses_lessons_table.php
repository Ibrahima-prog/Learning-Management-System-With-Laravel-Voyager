<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCoursesLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('courses_lessons', function(Blueprint $table)
		{
			$table->foreign('course_id', 'courses_lessons_ibfk_1')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('lesson_id', 'courses_lessons_ibfk_2')->references('id')->on('lessons')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('courses_lessons', function(Blueprint $table)
		{
			$table->dropForeign('courses_lessons_ibfk_1');
			$table->dropForeign('courses_lessons_ibfk_2');
		});
	}

}
