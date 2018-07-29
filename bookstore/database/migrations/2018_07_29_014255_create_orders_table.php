<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('address');
            $table->decimal('total_price', 10 , 2)->default(0.0);
            $table->decimal('price', 8, 2)->default(0.0);
            $table->decimal('tax_price', 8, 2)->default(0.0);
            $table->timestamp('datetime_created');
            $table->timestamp('datetime_ordered')->nullable()->default(null);
            $table->boolean('payed_order')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
