<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsResultsAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tests_results_answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tests_result_id')->unsigned()->nullable()->index('tests_results_answers_tests_result_id_foreign');
			$table->integer('question_id')->unsigned()->nullable()->index('tests_results_answers_question_id_foreign');
			$table->integer('option_id')->unsigned()->nullable()->index('tests_results_answers_option_id_foreign');
			$table->boolean('correct')->default(0);
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
		Schema::drop('tests_results_answers');
	}

}
