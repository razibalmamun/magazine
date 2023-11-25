<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeAresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_ares', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('designation');
            $table->text('details');
            $table->unsignedBigInteger('div_id');
            $table->foreign('div_id')->references('id')->on('division_wes')->onDelete('cascade');
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
        Schema::dropIfExists('we_ares');
    }
}
