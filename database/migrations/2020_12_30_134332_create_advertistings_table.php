<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertistingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertistings', function (Blueprint $table) {
            $table->id();
            $table->integer('proj_id');
            $table->integer('position')->default(1);
            $table->string('name');
            $table->string('url');
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('advertistings');
    }
}
