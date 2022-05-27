<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->uuid('uuid')->index()->unique();
            $table->string('bankname', 255)->nullable();
            $table->string('nameinaccount', 255)->nullable();
            $table->string('accountnumber', 255)->nullable();
            $table->string('branch', 255)->nullable();
            $table->string('ifsccode', 255)->nullable();
            $table->string('acctype', 255)->nullable();
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
        Schema::dropIfExists('bankdetails');
    }
}
