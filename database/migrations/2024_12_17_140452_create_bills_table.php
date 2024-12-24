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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->string('title');
            $table->string('b_name');
            $table->string('b_email');
            $table->string('b_phone');
            $table->string('b_address')->default('null');
            $table->string('b_city')->default('null');
            $table->string('b_state')->default('null');
            $table->integer('b_pincode')->default('0');
            $table->integer('f_amount')->default('0');
            $table->string('is_deleted')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
