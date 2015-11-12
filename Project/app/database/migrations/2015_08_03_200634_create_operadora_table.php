<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperadoraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operadora', function (Blueprint $table) {
			$table->engine = 'MyISAM';

			$table->integer('rn1');
			$table->char('carrier', 50);
			$table->primary('rn1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('operadora');
	}

}
