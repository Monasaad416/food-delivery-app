<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('restaurants', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_details', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_details', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_restaurant', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('category_restaurant', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('paid_commissions', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('paid_commissions', function(Blueprint $table) {
			$table->foreign('bank_id')->references('id')->on('banks')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('restaurants', function(Blueprint $table) {
			$table->dropForeign('restaurants_region_id_foreign');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->dropForeign('regions_city_id_foreign');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_restaurant_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_client_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_restaurant_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_region_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_restaurant_id_foreign');
		});
		Schema::table('order_details', function(Blueprint $table) {
			$table->dropForeign('order_details_order_id_foreign');
		});
		Schema::table('order_details', function(Blueprint $table) {
			$table->dropForeign('order_details_item_id_foreign');
		});
		Schema::table('category_restaurant', function(Blueprint $table) {
			$table->dropForeign('category_restaurant_category_id_foreign');
		});
		Schema::table('category_restaurant', function(Blueprint $table) {
			$table->dropForeign('category_restaurant_restaurant_id_foreign');
		});
		Schema::table('paid_commissions', function(Blueprint $table) {
			$table->dropForeign('paid_commissions_restaurant_id_foreign');
		});
		Schema::table('paid_commissions', function(Blueprint $table) {
			$table->dropForeign('paid_commissions_bank_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_restaurant_id_foreign');
		});
	}
}
