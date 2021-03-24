<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTestsQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tests_questions', function(Blueprint $table)
		{
			$table->foreign('question_id', 'tests_questions_ibfk_1')->references('id')->on('questions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('test_id', 'tests_questions_ibfk_2')->references('id')->on('tests')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tests_questions', function(Blueprint $table)
		{
			$table->dropForeign('tests_questions_ibfk_1');
			$table->dropForeign('tests_questions_ibfk_2');
		});
	}

}
