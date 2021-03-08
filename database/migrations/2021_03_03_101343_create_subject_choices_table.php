<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_choices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('layer_id')->unique();
            $table->timestamps();

            $table->unique(['subject_id', 'layer_id']);

            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('layer_id')->references('id')->on('layers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_choices');
    }
}