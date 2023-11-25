<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->nullable();
            $table->unsignedBigInteger('news_id')->nullable();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->text('title')->nullable();
            $table->text('share_title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('page_img')->nullable();
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
        Schema::dropIfExists('seos');
    }
}
