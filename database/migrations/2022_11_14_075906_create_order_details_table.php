<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration {

	public function up()
	{
		Schema::create('order_details', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('qty');
			$table->decimal('item_price');
			$table->decimal('total_price');
			$table->integer('preparation_time');
			$table->string('add_special');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('order_details');
	}
}
