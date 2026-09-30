<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Library Admin',
            'email'    => 'admin@library.com',
            'password' => Hash::make('password'),
        ]);
    }
}
