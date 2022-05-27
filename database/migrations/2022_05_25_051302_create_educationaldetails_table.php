<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationaldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educationaldetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->uuid('uuid')->index()->unique();
            $table->string('qualication', 255)->nullable();
            $table->string('institutename', 255)->nullable();
            $table->string('board_uni', 255)->nullable();
            $table->string('yearofpasing', 255)->nullable();
            $table->string('percenages', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educationaldetails');
    }
}
