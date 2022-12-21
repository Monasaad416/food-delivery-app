<?php

use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->integer('region_id')->unsigned();
			$table->decimal('min_order_charge');
			$table->decimal('delivery_fees');
			$table->string('whats_app_url')->nullable();
			$table->string('phone');
			$table->string('image');
            $table->mediumInteger('pin_code')->nullable();
			$table->boolean('availability')->nullable()->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
