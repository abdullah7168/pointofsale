<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordtls_ord_id');
            $table->integer('ordtls_rcp_id');
            
            $table->foreign('ordtls_ord_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
            $table->foreign('ordtls_rcp_id')
                  ->references('id')->on('recipes')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('orderdetails');
    }
}
