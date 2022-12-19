<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 191);
			$table->string('pin_code')->nullable();
			$table->string('email')->unique();
			$table->date('birthdate');
			$table->integer('bloodtype_id')->unsigned();
			$table->date('lastdonation_date');
			$table->integer('city_id')->unsigned();
			$table->string('phone', 191)->unique();
			$table->string('password', 191);
			$table->string('password_confirmation', 191);
			$table->string('api_token', 60)->unique()->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->enum('isactive', array('0', '1'))->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}