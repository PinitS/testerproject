<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailmaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detailmaterials', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_set_id');
            $table->integer('order_detail_id');
            $table->integer('material_id');
            $table->text('materialName');
            $table->integer('price');
            $table->integer('quatity');
            $table->integer('total_price');
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
        Schema::dropIfExists('order_detailmaterials');
    }
}
