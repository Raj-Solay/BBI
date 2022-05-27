<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->uuid('uuid')->index()->unique();
            $table->string('birthidentificationmarks', 255)->nullable();
            $table->string('birthidentificationmarks2', 255)->nullable();
            $table->string('handuse', 255)->nullable();
            $table->string('height', 255)->nullable();
            $table->string('weight', 255)->nullable();
            $table->string('bloodgroup', 255)->nullable();
            $table->string('willingtodonate', 255)->nullable();
            $table->string('physycalhandicape', 255)->nullable();
            $table->string('typeofph', 255)->nullable();
            $table->string('surgelesstreatmentundergo', 255)->nullable();
            $table->string('typeofsurgery', 255)->nullable();
            $table->string('anyotherhealthissue', 255)->nullable();
            $table->string('otherissuesdetail', 255)->nullable();
            $table->string('anyunhealthyhabit', 255)->nullable();
            $table->string('habbitdetails', 255)->nullable();
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
        Schema::dropIfExists('healthdetails');
    }
}
