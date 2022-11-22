<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTokensTable extends Migration {

	public function up()
	{
		Schema::create('notification_tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('device_token');
			$table->tinyInteger('device_type');
			$table->morphs('tokenable');
		});
	}

	public function down()
	{
		Schema::drop('notification_tokens');
	}
}
