<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingtonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringtones', function (Blueprint $table) {
            $table->id();
            $table->String('title');
            $table->text('description');
            $table->String('slug');
            $table->String('file');
            $table->String('format')->nullable();
            $table->String('size')->nullable();
            $table->integer('category_id');
            $table->String('download')->default(0);

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
        Schema::dropIfExists('ringtones');
    }
}
