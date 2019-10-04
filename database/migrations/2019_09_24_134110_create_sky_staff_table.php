<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkyStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sky_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('dob')->nullable();
            $table->text('pob')->nullable();
            $table->text('gender')->nullable();
            $table->text('phone')->nullable();
            $table->text('addr')->nullable();
            $table->text('ktpno')->nullable();
            $table->text('photoktp')->nullable();
            $table->text('picfile')->nullable();
            $table->text('datestart')->nullable();
            $table->text('dateresign')->nullable();
            $table->text('sp1')->nullable();
            $table->text('password')->nullable();
            $table->text('admin')->nullable();
            $table->text('inactive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sky_staff');
    }
}
