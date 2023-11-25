<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisheds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('published_by')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('news_id');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
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
        Schema::dropIfExists('publisheds');
    }
}
