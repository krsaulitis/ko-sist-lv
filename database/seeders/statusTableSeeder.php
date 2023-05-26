<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class statusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = Status::all();

        $roles = ['bandmaster', 'vocal_coach', 'member'];

        if (count($status) === 0) {
            foreach ($roles as $item) {
                Status::create([
                    'name' => $item
                ]);
            }

            User::create([
                'name' => 'admin',
                'email' => 'admin@tester.com',
                'password' => '$2y$10$I2gKu2npPopJZ3SXEezGjOrUVWH.JG/mJvDGt9h5WyRmGzxeEmkau', // password - kj555719
                'status_id' => 1,
            ]);
        }
    }
}
