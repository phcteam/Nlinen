<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_linen', function (Blueprint $table) {
            $table->id();
            $table->string('DocNo');
            $table->date('DocDate');
            $table->string('HptCode');
            $table->string('IsStatus');
            $table->string('FacCode');
            $table->string('SignFac');
            $table->string('SignNH');
            $table->dateTime('SignFacTime');
            $table->dateTime('SignNHTime');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_linen');
    }
};
