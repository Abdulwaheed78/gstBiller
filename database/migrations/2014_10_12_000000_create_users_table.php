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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('user_type');
            $table->string('image')->default('null');
            $table->string('password');
            $table->string('address')->default('null');
            $table->string('city')->default('null');
            $table->string('state')->default('null');
            $table->integer('pincode')->default('0');
            $table->string('is_deleted')->default('no');
            $table->integer('otp')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
