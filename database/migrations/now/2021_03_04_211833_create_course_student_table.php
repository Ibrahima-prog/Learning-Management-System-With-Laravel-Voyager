<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_student', function(Blueprint $table)
		{
			$table->integer('course_id')->unsigned()->nullable()->index('course_student_course_id_foreign');
			$table->bigInteger('user_id')->unsigned()->nullable()->index('user_id');
			$table->integer('rating')->unsigned()->default(0);
			$table->timestamps(6);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_student');
	}

}
