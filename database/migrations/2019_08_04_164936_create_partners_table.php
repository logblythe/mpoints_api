<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('custom_id', 6)->unique();
            $table->string('business_name');
            $table->text('description_html');
            $table->string('image');
            $table->integer('phone');
            $table->string('email');
            $table->string('website');
            $table->string('facebook');
            $table->string('mp_rate');
            $table->string('sp_rate');
            $table->boolean('active_inactive');
            $table->smallInteger('category_id');
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
        Schema::dropIfExists('partners');
    }
}
