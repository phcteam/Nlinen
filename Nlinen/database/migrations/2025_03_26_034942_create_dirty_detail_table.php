<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('dirty_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clean_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('unit_id');
            $table->float('qty');
            $table->float('weight');
            $table->string('request_name');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('dirty_detail');
    }
};
