<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Baba Books',
            'email' => 'baba@admin.com',
            'phone'=>'7718929730',
            'user_type'=>'admin',
            'password' => Hash::make('admin@12'),
        ]);
    }
}
