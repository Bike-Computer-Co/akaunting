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
        Schema::create('firm_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('form_of_firm');
            $table->string('founder_id_number')->nullable();
            $table->string('firm_name');
            $table->string('founder_name');
            $table->string('founder_address');
            $table->string('founder_embg');
            $table->string('manager_name');
            $table->string('manager_address');
            $table->string('manager_embg');
            $table->string('headquarters_address');
            $table->unsignedBigInteger('headquarters_municipality_id');
            $table->foreign('headquarters_municipality_id')->references('id')->on('municipalities');
            $table->unsignedBigInteger('headquarters_settlement_id')->nullable();
            $table->foreign('headquarters_settlement_id')->references('id')->on('settlements');
            $table->string('subsidiary_address');
            $table->unsignedBigInteger('subsidiary_municipality_id');
            $table->foreign('subsidiary_municipality_id')->references('id')->on('municipalities');
            $table->unsignedBigInteger('subsidiary_settlement_id')->nullable();
            $table->foreign('subsidiary_settlement_id')->references('id')->on('settlements');
            $table->string('occupation_code');
            $table->unsignedTinyInteger('stake_duration');
            $table->unsignedTinyInteger('stake_type');
            $table->foreignId('bank_id')->constrained();
            $table->string('phone');
            $table->string('email');
            $table->string('stamp_address')->nullable();
            $table->unsignedTinyInteger('stamp_type')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('firm_registrations');
    }
};
