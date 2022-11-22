<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('body');
			$table->morphs('notifiable');
			$table->timestamps();
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')
            ->onDelete('cascade')
            ->onUpdate('cascade');
			$table->boolean('is_read')->default(false);
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
