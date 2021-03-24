<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lesson_students', function(Blueprint $table)
		{
			$table->integer('lesson_id')->unsigned()->index('lesson_students_lesson_id_foreign');
			$table->bigInteger('user_id')->unsigned()->index('lesson_students_user_id_foreign');
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
		Schema::drop('lesson_students');
	}

}
