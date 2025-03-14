<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{

    public function up()
    {
        Schema::create('Sections', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Section');
            $table->integer('Status');
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('Class_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Sections');
    }
}