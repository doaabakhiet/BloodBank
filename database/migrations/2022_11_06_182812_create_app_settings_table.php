<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration {

	public function up()
	{
		Schema::create('app_settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone');
			$table->string('email')->unique();
			$table->string('facebook');
			$table->string('instagram');
			$table->string('youtube');
			$table->longText('about_app');
			$table->string('twitter');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('app_settings');
	}
}