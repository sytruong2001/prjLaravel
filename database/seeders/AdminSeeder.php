<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Trương Sỹ',
            'email' => 'sa@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $superAdmin->assignRole('Super Admin', 'Admin', 'User');

        $admin = User::create([
            'name' => 'TNguyen',
            'email' => 'ad@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $admin->assignRole('Admin', 'User');


        $user = User::create([
            'name' => 'Nguoi dung',
            'email' => 'user@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole('User');
    }
}