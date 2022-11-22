<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email');
			$table->text('about_us')->nullable();
			$table->decimal('app_commession');
			$table->string('commission_text');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
