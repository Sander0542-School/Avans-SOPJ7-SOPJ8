<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layer_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layer_id')->constrained('layers', 'id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            $table->string('action');
            $table->string('name');
            $table->string('slug');
            $table->text('content');

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
        Schema::dropIfExists('layer_histories');
    }
}
