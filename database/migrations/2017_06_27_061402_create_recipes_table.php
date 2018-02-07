<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rcp_name');
            $table->longText('rcp_dscp');
            $table->longText('rscp_ingts');
            $table->decimal('rcp_cp',5,2);
            $table->decimal('rcp_sp',5,2);
            $table->integer('rcp_cat_id');
            $table->foreign('rcp_cat_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
            $table->string('recipeThumb')->nullable();;
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
        Schema::dropIfExists('recipes');
    }
}
