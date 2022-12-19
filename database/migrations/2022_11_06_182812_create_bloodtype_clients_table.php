<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodtypeClientsTable extends Migration {

	public function up()
	{
		Schema::create('bloodtype_clients', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->integer('bloodtype_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('bloodtype_clients');
	}
}