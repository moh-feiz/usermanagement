<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique()->notNullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('role')->notNullable()->comment = '10=user , 20=admin';
            $table->integer('status')->notNullable()->comment = '10=deactive,20=active';
            $table->integer('verify_code')->nullable();
            $table->dateTime('verification_sms_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
