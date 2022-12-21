<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_code_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name_surname');
            $table->string('email');
            $table->string('phone_number');
            $table->boolean('registered_firm');
            $table->boolean('accountant');
            $table->boolean('advocate');
            $table->string('code');
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
        Schema::dropIfExists('gift_code_applicants');
    }
};
