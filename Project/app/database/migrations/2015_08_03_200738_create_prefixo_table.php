<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefixoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prefixo', function (Blueprint $table) {
			$table->engine = 'MyISAM';

			$table->char('carrier', 50)->nullable();
			$table->char('type', 1)->nullable();
			$table->integer('rn1')->nullable();
			$table->integer('ddd')->nullable();
			$table->char('prefix', 5)->nullable();
			$table->char('mdu_initial', 4)->nullable();
			$table->char('mdu_final', 4)->nullable();
			$table->char('eot', 3)->nullable();
			$table->char('uf', 2)->nullable();
			$table->integer('cnl')->nullable();
			$table->index('rn1');
			$table->index('ddd');
			$table->index('prefix');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prefixo');
	}

}
