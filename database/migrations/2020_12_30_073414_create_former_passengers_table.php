<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormerPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('former_passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->notNullable();
            $table->string('first_name_fa')->nullable();
            $table->string('last_name_fa')->nullable();
            $table->string('first_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('social_code')->nullable()->comment('کدملی');
            $table->string('mobile')->nullable();
            $table->string('passport_number')->nullable();
            $table->integer('country_passport')->nullable()->comment(' کشور صادرکننده پاسپورت');
            $table->date('expire_date_passport')->nullable()->comment('تاریخ انقضای پاسپورت');
            $table->integer('gender')->notNullable()->comment('10=Female,20=Male');
            $table->date('birthday')->notNullable();
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
        Schema::dropIfExists('former_passengers');
    }
}
