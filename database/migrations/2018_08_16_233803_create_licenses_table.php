<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contract')->nullable();
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
        Schema::dropIfExists('licenses');
    }
}
