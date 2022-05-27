<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->uuid('uuid')->index()->unique();
            $table->string('name', 255)->nullable();
            $table->string('relation', 255)->nullable();
            $table->string('age', 255)->nullable();
            $table->string('education', 255)->nullable();
            $table->string('occupation', 255)->nullable();
            $table->string('monthlyincome', 255)->nullable();
            $table->string('contactno', 255)->nullable();
            $table->string('address', 255)->nullable();
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
        Schema::dropIfExists('family_details');
    }
}
