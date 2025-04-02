<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "User $i",
                'username' => "user$i",
                'email' => "user$i@example.com",
                'permission_id' => rand(1, 5), // สุ่มค่า 1-5
                'password' => Hash::make('password'), // ตั้งรหัสผ่านเริ่มต้น
            ]);
        }
    }
}
