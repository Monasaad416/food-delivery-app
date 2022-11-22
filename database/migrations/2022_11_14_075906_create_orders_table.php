<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->string('address');
			$table->integer('payment_method_id');
			// $table->integer('preparation_time');
			$table->string('notes')->nullable();
			$table->tinyInteger('availability')->default(Order::PENDING);
			$table->decimal('order_price');
			$table->decimal('delivery_fees');
			$table->decimal('total_price');
			$table->decimal('commission_fees');
			$table->integer('client_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
