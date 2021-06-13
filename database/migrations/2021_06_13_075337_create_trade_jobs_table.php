<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('card_id')->nullable();
            $table->bigInteger('bundle_id')->nullable();
            $table->bigInteger('user_id');
            $table->dateTime('whenTime')->nullable();
            $table->float('whenPriceBigger')->nullable();
            $table->float('whenPriceSmaller')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('trade_jobs');
    }
}
