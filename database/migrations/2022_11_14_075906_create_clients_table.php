<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->integer('region_id')->unsigned();
            $table->mediumInteger('pin_code')->nullable();
            $table->boolean('status')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
