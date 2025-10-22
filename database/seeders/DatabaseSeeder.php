<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Buat akun admin
        User::updateOrCreate(
            ['email' => 'mando@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Sumda#0046'),
                'role' => 'admin',
            ]
        );

        // 2️⃣ Buat akun peserta
        User::updateOrCreate(
            ['email' => 'arla@gmail.com'],
            [
                'name' => 'Azwa Nisyiatul Rizky',
                'password' => Hash::make('password'),
                'role' => 'peserta',
            ]
        );

        // 3️⃣ Tambahkan soal dummy kalau belum ada
        if (Question::count() === 0) {
            Question::insert([
                [
                    'question'   => 'Ibukota Indonesia adalah?',
                    'option_a'   => 'Jakarta',
                    'option_b'   => 'Bandung',
                    'option_c'   => 'Surabaya',
                    'option_d'   => 'Medan',
                    'option_e'   => 'Makassar',
                    'answer'     => 'a',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question'   => '2 + 2 = ?',
                    'option_a'   => '3',
                    'option_b'   => '4',
                    'option_c'   => '5',
                    'option_d'   => '6',
                    'option_e'   => '7',
                    'answer'     => 'b',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question'   => 'Hewan pemakan tumbuhan disebut?',
                    'option_a'   => 'Karnivora',
                    'option_b'   => 'Omnivora',
                    'option_c'   => 'Herbivora',
                    'option_d'   => 'Insektivora',
                    'option_e'   => 'Detritivora',
                    'answer'     => 'c',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // 4️⃣ Tambahkan dummy user & soal random hanya kalau belum ada
        if (User::count() < 5) {
            User::factory(10)->create();
        }

        if (Question::count() < 50) {
            Question::factory(47)->create();
        }
    }
}
