<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lessons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title');
			$table->text('slug');
			$table->text('lesson_image')->nullable();
			$table->text('short_text')->nullable();
			$table->text('full_text')->nullable();
			$table->integer('position')->nullable();
			$table->text('files')->nullable();
			$table->integer('free_lesson')->nullable();
			$table->integer('published')->nullable();
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
		Schema::drop('lessons');
	}

}
