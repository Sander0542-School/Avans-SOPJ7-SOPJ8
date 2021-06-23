<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteCascadeSubjectChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subject_choices', function (Blueprint $table) {
            $table->dropForeign('subject_choices_subject_id_foreign');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subject_choices', function (Blueprint $table) {
            $table->dropForeign('subject_choices_subject_id_foreign');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }
}
