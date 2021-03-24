<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNcourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_ncourse', function(Blueprint $table)
		{
			$table->bigInteger('n_course_id')->unsigned()->index('user_ncourse_ncourse_id_index');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->primary(['n_course_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_ncourse');
	}

}
