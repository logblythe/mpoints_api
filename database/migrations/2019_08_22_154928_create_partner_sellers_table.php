<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('custom_id');
            $table->string('partner_id');
            $table->string('brn');
            $table->string('main_store')->nullable();
            $table->string('seller_name');
            $table->string('phone');
            $table->string('email');
            $table->boolean('active_inactive');
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
        Schema::dropIfExists('partner_sellers');
    }
}
