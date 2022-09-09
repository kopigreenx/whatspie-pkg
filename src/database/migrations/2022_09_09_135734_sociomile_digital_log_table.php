<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SociomileDigitalLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociomile_digital_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('internal_id');
            $table->string('user_id');
            $table->string('name');
            $table->string('phone');
            $table->longText('message');
            $table->json('response');
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
        Schema::dropIfExists('sociomile_digital_log');
    }
}
