<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->string('name', 191);
			$table->float('age');
			$table->integer('bloodtype_id')->unsigned();
			$table->integer('num_of_bags');
			$table->integer('city_id')->unsigned();
			$table->decimal('longtitude', 10,8);
			$table->decimal('latitude', 10,8);
			$table->string('phone');
			$table->longText('notes');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}