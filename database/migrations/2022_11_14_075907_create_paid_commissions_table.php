<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidCommissionsTable extends Migration {

	public function up()
	{
		Schema::create('paid_commissions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('paid');
			$table->datetime('payment_date');
			$table->text('notes')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('bank_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('paid_commissions');
	}
}
