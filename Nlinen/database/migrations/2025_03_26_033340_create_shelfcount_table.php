<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('shelfcount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->string('shelfcount_DocNo');
            $table->unsignedBigInteger('department_id');
            $table->string('is_Request');
            $table->string('delivery_time');
            $table->string('sc_time');
            $table->string('is_mobile');
            $table->string('complete_user');
            $table->date('complete_date');
            $table->unsignedBigInteger('cancel_user_id');
            $table->string('cancel_remark');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelfcount');
    }
};
