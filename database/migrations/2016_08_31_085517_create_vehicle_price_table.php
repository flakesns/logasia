<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id');
            $table->date('date_avail');
            $table->integer('numb_avail')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
            $table->unique(['vehicle_id', 'date_avail']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehicle_prices');
    }
}
