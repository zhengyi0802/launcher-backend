<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnounceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announce_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('proj_id');
            $table->string('name');
            $table->string('mime_type');
            $table->string('url');
            $table->text('detial');
            $table->boolean('status');
            $table->datetime('start_datetime');
            $table->datetime('stop_datetime');
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
        Schema::dropIfExists('announce_contents');
    }
}
