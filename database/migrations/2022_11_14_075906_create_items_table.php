<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->decimal('price');
			$table->decimal('discount_price')->nullable();
			$table->integer('preparation_time');
			$table->string('image');
			$table->integer('restaurant_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}
