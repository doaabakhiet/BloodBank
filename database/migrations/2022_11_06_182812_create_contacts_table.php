<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->string('title');
			$table->longText('content');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}