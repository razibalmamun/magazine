<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('subcategories')->onDelete('cascade');
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
        Schema::dropIfExists('news_sub_categories');
    }
}
