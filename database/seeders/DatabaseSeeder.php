<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->phone = '21231234';
        $user->password = Hash::make('option123');
        $user->role = User::ROLE_ADMIN;
        $user->save();
    }
}
