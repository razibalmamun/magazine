<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->integer('count');
            $table->date('date');
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
        Schema::dropIfExists('latests');
    }
}
