<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //
        Schema::create('products',function(Blueprint $table){
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('image');
            $table->timestamps();
            $table->float('our_price');
            $table->float('market_price');
            $table->integer('number');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
