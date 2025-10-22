<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $questions = [
            [
                'question' => 'Hasil dari 125 ÷ 5 adalah ...',
                'option_a' => '20',
                'option_b' => '25',
                'option_c' => '15',
                'option_d' => '30',
                'option_e' => '35',
                'answer' => 'B',
            ],
            [
                'question' => 'Sumber energi utama bagi manusia berasal dari ...',
                'option_a' => 'air',
                'option_b' => 'udara',
                'option_c' => 'makanan',
                'option_d' => 'minyak bumi',
                'option_e' => 'matahari',
                'answer' => 'C',
            ],
            [
                'question' => 'Ibu kota provinsi Jawa Tengah adalah ...',
                'option_a' => 'Semarang',
                'option_b' => 'Solo',
                'option_c' => 'Magelang',
                'option_d' => 'Purwokerto',
                'option_e' => 'Tegal',
                'answer' => 'A',
            ],
            [
                'question' => 'Sinonim dari kata “indah” adalah ...',
                'option_a' => 'jelek',
                'option_b' => 'cantik',
                'option_c' => 'aneh',
                'option_d' => 'buruk',
                'option_e' => 'gelap',
                'answer' => 'B',
            ],
            [
                'question' => 'Nilai tempat angka 7 pada bilangan 7.582 adalah ...',
                'option_a' => 'ratusan',
                'option_b' => 'ribuan',
                'option_c' => 'puluhan',
                'option_d' => 'satuan',
                'option_e' => 'puluh ribu',
                'answer' => 'B',
            ],
            [
                'question' => 'Pancasila sila ketiga berbunyi ...',
                'option_a' => 'Ketuhanan Yang Maha Esa',
                'option_b' => 'Kemanusiaan yang adil dan beradab',
                'option_c' => 'Persatuan Indonesia',
                'option_d' => 'Kerakyatan yang dipimpin oleh hikmat kebijaksanaan',
                'option_e' => 'Keadilan sosial bagi seluruh rakyat Indonesia',
                'answer' => 'C',
            ],
            [
                'question' => 'Air menguap karena pengaruh ...',
                'option_a' => 'angin',
                'option_b' => 'panas',
                'option_c' => 'dingin',
                'option_d' => 'cahaya',
                'option_e' => 'tekanan',
                'answer' => 'B',
            ],
            [
                'question' => 'Kalimat tanya diakhiri dengan tanda ...',
                'option_a' => '.',
                'option_b' => '!',
                'option_c' => '?',
                'option_d' => ',',
                'option_e' => ';',
                'answer' => 'C',
            ],
            [
                'question' => 'Perubahan wujud dari cair menjadi gas disebut ...',
                'option_a' => 'membeku',
                'option_b' => 'menguap',
                'option_c' => 'mengembun',
                'option_d' => 'menyublim',
                'option_e' => 'mencair',
                'answer' => 'B',
            ],
            [
                'question' => 'Lambang negara Indonesia adalah ...',
                'option_a' => 'Bendera Merah Putih',
                'option_b' => 'Garuda Pancasila',
                'option_c' => 'Burung Rajawali',
                'option_d' => 'Bambu Runcing',
                'option_e' => 'Sang Saka Merah Putih',
                'answer' => 'B',
            ],
            // --- Tambahkan soal lain hingga 50 ---
        ];

        // Tambahkan soal sampai 50 (otomatis variasi sederhana)
        $extraQuestions = [];
        for ($i = 11; $i <= 50; $i++) {
            $extraQuestions[] = [
                'question' => "Berapakah hasil dari $i + 5?",
                'option_a' => $i + 3,
                'option_b' => $i + 4,
                'option_c' => $i + 5,
                'option_d' => $i + 6,
                'option_e' => $i + 7,
                'answer' => 'C',
            ];
        }

        $allQuestions = array_merge($questions, $extraQuestions);

        // Tambahkan timestamp created_at & updated_at
        foreach ($allQuestions as &$q) {
            $q['created_at'] = $now;
            $q['updated_at'] = $now;
        }

        DB::table('questions')->insert($allQuestions);
    }
};
