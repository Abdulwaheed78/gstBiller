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
        Schema::create('bill_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->string('description')->default('null');
            $table->integer('qty')->default('0');
            $table->integer('gst_rate');
            $table->integer('gst_amount');
            $table->integer('actual_amount');
            $table->integer('final_amount');
            $table->integer('puc');
            $table->string('is_deleted')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_trans');
    }
};
