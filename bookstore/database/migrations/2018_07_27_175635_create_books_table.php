<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->unique();
            $table->integer('quantity');
            $table->string('genre', 7);
            $table->double('rating',3,2);
            $table->double('price', 6, 2);
            $table->mediumText('description');
            $table->string('publisher', 255);
            $table->date('release_date');
            $table->integer('amount_sold');
            $table->integer('review_count')->default(20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
