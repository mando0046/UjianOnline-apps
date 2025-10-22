<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Harman Hariady',
                'email' => 'mando@gmail.com',
                'password' => 'Sumda#0046',
                'role' => 'admin',
            ],
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => 'password',
                'role' => 'peserta',
            ],
            [
                'name' => 'Assyifa Divya Carla',
                'email' => 'arla@gmail.com',
                'password' => 'password',
                'role' => 'peserta',
            ],
            [
                'name' => 'Tamu Ujian',
                'email' => 'tamu@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],
             [
                'name' => 'Suryadi Pratama',
                'email' => 'surya@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],
            [
                'name' => 'Singgih Suandi',
                'email' => 'ingkeh@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],
            [
                'name' => 'Rizki Ramadhan',
                'email' => 'rizki@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'sartika@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => 'password',
                'role' => 'guest',
            ],      
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']], // supaya tidak dobel kalau seed berkali-kali
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => $data['role'],
                ]
            );
        }
    }
}
