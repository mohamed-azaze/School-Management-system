<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('Classrooms', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Sections', function (Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Schema::table('Sections', function(Blueprint $table) {
        //     $table->foreign('Class_id')->references('id')->on('Classrooms')
        //                 ->onDelete('cascade')
        //                 ->onUpdate('cascade');
        // });
        Schema::table('my__parents', function (Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });

        Schema::table('parent_attachments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')
                ->onDelete('cascade')
                ->onUpdate('cascade');;
        });
    }

    public function down()
    {
        Schema::table('Classrooms', function (Blueprint $table) {
            $table->dropForeign('Classrooms_Grade_id_foreign');
        });
        Schema::table('Sections', function (Blueprint $table) {
            $table->dropForeign('Sections_Grade_id_foreign');
        });
        Schema::table('Sections', function (Blueprint $table) {
            $table->dropForeign('Sections_Class_id_foreign');
        });
    }
}