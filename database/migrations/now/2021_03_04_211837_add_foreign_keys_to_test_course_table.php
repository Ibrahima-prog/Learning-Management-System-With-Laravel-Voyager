<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTestCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('test_course', function(Blueprint $table)
		{
			$table->foreign('course_id', 'test_course_ibfk_1')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('test_id', 'test_course_ibfk_2')->references('id')->on('tests')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('test_course', function(Blueprint $table)
		{
			$table->dropForeign('test_course_ibfk_1');
			$table->dropForeign('test_course_ibfk_2');
		});
	}

}
