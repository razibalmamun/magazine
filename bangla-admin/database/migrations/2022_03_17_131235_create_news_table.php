<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('sort_description');
            $table->bigInteger('category_id');
            $table->bigInteger('sub_category_id')->nullable();
            $table->integer('order')->nullable();
            $table->integer('proofreader')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->string('type');
            $table->bigInteger('timeline_id')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('latest')->default(0);
            $table->boolean('news_marquee')->default(0);
            $table->boolean('live_news')->default(0);
            $table->dateTime('date');
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
        Schema::dropIfExists('news');
    }
}
