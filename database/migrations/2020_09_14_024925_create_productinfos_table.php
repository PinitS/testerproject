<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productinfos', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('category_id');
            $table->integer('active_count');
            $table->integer('count_quatity');
            $table->integer('active');
            $table->string('name');
            $table->integer('cost');
            $table->integer('price');
            $table->integer('product_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productinfos');
    }
}
