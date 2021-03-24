<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPivotQuestionsOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pivot_questions_options', function(Blueprint $table)
		{
			$table->foreign('questions_option_id', 'pivot_questions_options_ibfk_1')->references('id')->on('questions_options')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('question_id', 'pivot_questions_options_ibfk_2')->references('id')->on('questions')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pivot_questions_options', function(Blueprint $table)
		{
			$table->dropForeign('pivot_questions_options_ibfk_1');
			$table->dropForeign('pivot_questions_options_ibfk_2');
		});
	}

}
