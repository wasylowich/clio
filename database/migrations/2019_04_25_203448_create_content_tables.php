<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label', 45);

            $table->unique('label');
        });

        Schema::create('content_type_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_type')->unsigned();
            $table->string('label', 45);

            $table->foreign('content_type')->references('id')->on('content_type');
        });

        Schema::create('content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_type')->unsigned();
            $table->string('title', 45);
            $table->text('body');
            $table->timestamps();

            $table->foreign('content_type')->references('id')->on('content_type');
        });

        Schema::create('property_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content')->unsigned();
            $table->bigInteger('content_type_property')->unsigned();
            $table->string('value', 45);

            $table->foreign('content')->references('id')->on('content');
            $table->foreign('content_type_property')->references('id')->on('content_type_property');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_value');
        Schema::dropIfExists('content');
        Schema::dropIfExists('content_type_property');
        Schema::dropIfExists('content_type');
    }
}
