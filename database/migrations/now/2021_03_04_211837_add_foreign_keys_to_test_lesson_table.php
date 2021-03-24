<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTestLessonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('test_lesson', function(Blueprint $table)
		{
			$table->foreign('lesson_id', 'test_lesson_ibfk_1')->references('id')->on('lessons')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('test_id', 'test_lesson_ibfk_2')->references('id')->on('tests')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('test_lesson', function(Blueprint $table)
		{
			$table->dropForeign('test_lesson_ibfk_1');
			$table->dropForeign('test_lesson_ibfk_2');
		});
	}

}
