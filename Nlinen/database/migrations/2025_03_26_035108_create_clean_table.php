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
        Schema::create('clean', function (Blueprint $table) {
            $table->id();
            $table->string('clean_DocNo');
            $table->string('status');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('factory_id');
            $table->unsignedBigInteger('dirty_id');
            $table->unsignedBigInteger('user_id');
            $table->string('signature');
            $table->string('sign_factory');
            $table->string('sign_factory_time');
            $table->string('sign_NH');
            $table->string('sign_NH_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean');
    }
};
