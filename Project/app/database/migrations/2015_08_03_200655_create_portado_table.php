<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portado', function (Blueprint $table) {
			$table->engine = 'MyISAM';
			$table->integer('version_id');
			$table->bigInteger('number')->nullable();
			$table->integer('rn1')->nullable();
			$table->dateTime('date')->nullable();
			$table->char('operation', 1)->nullable();
			$table->integer('eot')->nullable();
			$table->index('number');
			$table->index('rn1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('portado');
	}

}
