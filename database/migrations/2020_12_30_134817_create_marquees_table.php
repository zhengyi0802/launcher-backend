<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarqueesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->integer('proj_id');
            $table->string('name');
            $table->string('marquee1')->nullable();
            $table->string('marquee2')->nullable();
            $table->string('marquee3')->nullable();
            $table->string('marquee4')->nullable();
            $table->string('marquee5')->nullable();
            $table->string('marquee6')->nullable();
            $table->string('marquee7')->nullable();
            $table->string('marquee8')->nullable();
            $table->string('marquee9')->nullable();
            $table->string('marquee10')->nullable();
            $table->boolean('status')->default(true);
            $table->datetime('start_datetime')->nullable();
            $table->datetime('stop_datetime')->nullable();
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
        Schema::dropIfExists('marquees');
    }
}
