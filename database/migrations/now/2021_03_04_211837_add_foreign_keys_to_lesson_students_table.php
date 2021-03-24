<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLessonStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lesson_students', function(Blueprint $table)
		{
			$table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lesson_students', function(Blueprint $table)
		{
			$table->dropForeign('lesson_students_lesson_id_foreign');
			$table->dropForeign('lesson_students_user_id_foreign');
		});
	}

}
