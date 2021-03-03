<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayerChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layer_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_layer_id');
            $table->unsignedBigInteger('child_layer_id')->unique();
            $table->timestamps();

            $table->unique(['parent_layer_id', 'child_layer_id']);

            $table->foreign('parent_layer_id')->references('id')->on('layers');
            $table->foreign('child_layer_id')->references('id')->on('layers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layer_choices');
    }
}
