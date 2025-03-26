<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelfcount_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shelfcount_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('unit_id');
            $table->float('par_qty');
            $table->float('cc_qty');
            $table->float('total_qty');
            $table->float('over_par');
            $table->float('short');
            $table->float('over');
            $table->float('weight');
            $table->float('price');
            $table->float('category_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelfcount_detail');
    }
};
