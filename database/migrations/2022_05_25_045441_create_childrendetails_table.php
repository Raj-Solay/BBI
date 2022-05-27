<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrendetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrendetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->uuid('uuid')->index()->unique();
            $table->string('name', 255)->nullable();
            $table->string('age', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('stayawith', 255)->nullable();
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
        Schema::dropIfExists('childrendetails');
    }
}
