<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrendingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trending_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trending_id');
            $table->foreign('trending_id')->references('id')->on('keywords')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->text('details');
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
        Schema::dropIfExists('trending_details');
    }
}
