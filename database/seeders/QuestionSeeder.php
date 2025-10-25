<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel questions.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $questions = [
            // --- No 1  ------
            [
                'question' => 'Mobil : Bensin = Pelari : … ',
                'option_a' => 'sepatu',
                'option_b' => 'makanan',
                'option_c' => 'lari',
                'option_d' => 'energi',
                'option_e' => 'minuman',
                'answer' => 'D',
            ],
            // --- No 2  ------
            [
                'question' => 'Buku : Penulis = Lagu : ...',
                'option_a' => 'penyanyi',
                'option_b' => 'komposer',
                'option_c' => 'musik',
                'option_d' => 'lirik',
                'option_e' => 'lagu',
                'answer' => 'B',
            ],
            // --- No 3  ------
            [
                'question' => 'Kamera : Foto = Oven : ...',
                'option_a' => 'Roti',
                'option_b' => 'Memasak',
                'option_c' => 'Panas',
                'option_d' => 'Makanan',
                'option_e' => 'Minuman',
                'answer' => 'A',
            ],
            // --- No 4  ------
            [
                'question' => 'Jika 2x + 5 = 15, maka nilai x adalah ...',
                'option_a' => '5',
                'option_b' => '9',
                'option_c' => '10',
                'option_d' => '11.5',
                'option_e' => '12',
                'answer' => 'A',
            ],
            // --- No 5  ------
            [
                'question' => 'Berapakah 25% dari 200? ...',
                'option_a' => '25',
                'option_b' => '50',
                'option_c' => '75',
                'option_d' => '80',
                'option_e' => '90',
                'answer' => 'B',
            ],
            // --- No 6  ------
            [
                'question' => 'Jika 3 orang dapat menyelesaikan pekerjaan dalam 6 hari, berapa hari yang dibutuhkan 6 orang untuk menyelesaikan pekerjaan yang sama? ...',
                'option_a' => '5',
                'option_b' => '4',
                'option_c' => '3',
                'option_d' => '2',
                'option_e' => '1',
                'answer' => 'C',
            ],
			 // --- No 7  ------
            [
                'question' => 'Hasil dari 7² + 8 × 3 adalah  ...',
                'option_a' => '60',
                'option_b' => '73',
                'option_c' => '85',
                'option_d' => '93',
                'option_e' => '100',
                'answer' => 'B',
            ],
			 // --- No 8  ------
            [
                'question' => '2, 4, 6, 8,  ...',
                'option_a' => '9',
                'option_b' => '10',
                'option_c' => '11',
                'option_d' => '12',
                'option_e' => '13',
                'answer' => 'B',
            ],
			 // --- No 9  ------
            [
                'question' => '3, 6, 9, 12, ...',
                'option_a' => '15',
                'option_b' => '18',
                'option_c' => '19',
                'option_d' => '20',
                'option_e' => '24',
                'answer' => 'A',
            ],
			 // --- No 10  ------
            [
                'question' => '5, 10, 20, 40,  ...',
                'option_a' => '50',
                'option_b' => '60',
                'option_c' => '65',
                'option_d' => '75',
                'option_e' => '80',
                'answer' => 'E',
            ], // --- No 11  ------
            [
                'question' => '1, 4, 9, 16, ...',
                'option_a' => '20',
                'option_b' => '25',
                'option_c' => '15',
                'option_d' => '30',
                'option_e' => '35',
                'answer' => 'B',
            ],
			 // --- No 12  ------
            [
                'question' => 'Jika A = 5, B = 10, dan C = 15, maka A + B – C = ...',
                'option_a' => '20',
                'option_b' => '15',
                'option_c' => '10',
                'option_d' => '5',
                'option_e' => '0',
                'answer' => 'E',
            ],
			 // --- No 13  ------
            [
                'question' => 'Jika 4x = 20, maka x = ...',
                'option_a' => '4',
                'option_b' => '5',
                'option_c' => '6',
                'option_d' => '7',
                'option_e' => '8',
                'answer' => 'B',
            ],
			 // --- No 14  ------
            [
                'question' => 'Jika 3y – 7 = 8, maka y = ...',
                'option_a' => '3',
                'option_b' => '5',
                'option_c' => '7',
                'option_d' => '9',
                'option_e' => '11',
                'answer' => 'B',
            ],
			 // --- No 15  ------
            [
                'question' => 'Jika 2a + 3b = 16 dan a = 2, maka b = ...',
                'option_a' => '2',
                'option_b' => '3',
                'option_c' => '4',
                'option_d' => '6',
                'option_e' => '8',
                'answer' => 'C',
            ],
			 // --- No 16  ------
            [
                'question' => ' Semua kucing adalah hewan. Beberapa hewan adalah mamalia. Kesimpulan yang tepat adalah',
                'option_a' => 'Semua kucing adalah mamalia. ',
                'option_b' => 'Beberapa kucing adalah mamalia. ',
                'option_c' => 'Semua mamalia adalah kucing.',
                'option_d' => 'Beberapa mamalia adalah kucing. ',
                'option_e' => 'Semua mamalia sudah pasti kucing.',
                'answer' => 'B',
            ],
			 // --- No 17  ------
            [
                'question' => 'Jika hari ini adalah Senin, maka 3 hari yang lalu adalah ...',
                'option_a' => 'kamis',
                'option_b' => 'jumat',
                'option_c' => 'sabtu',
                'option_d' => 'minggu',
                'option_e' => 'senin',
                'answer' => 'B',
            ],
			 // --- No 18  ------
            [
                'question' => 'Jarak kota Cirebon ke Kuningan 35 km dan terlihat pada peta 35cm, berarti peta tersebut berskala:...',
                'option_a' => '1: 350.000',
                'option_b' => '1:700.000',
                'option_c' => ' 1:175.000',
                'option_d' => '1:250.000',
                'option_e' => '1:100.000',
                'answer' => 'E',
            ],
			 // --- No 19  ------
            [
                'question' => 'Jika semua siswa rajin belajar, maka mereka akan lulus ujian. Andi lulus ujian. Kesimpulan yang tepat adalah ...',
                'option_a' => 'Andi rajin belajar. ',
                'option_b' => 'Andi tidak rajin belajar. ',
                'option_c' => 'Semua siswa rajin belajar. ',
                'option_d' => 'tidak dapat disimpulkan',
                'option_e' => 'Andi pemalas',
                'answer' => 'D',
            ],
			 // --- No 20  ------
            [
                'question' => 'Jika A > B dan B > C, maka ...',
                'option_a' => 'A > C',
                'option_b' => 'A < C',
                'option_c' => 'A = C',
                'option_d' => 'A ≠ C',
                'option_e' => 'Sang Saka Merah Putih',
                'answer' => 'A',
            ],
			 // --- No 21  ------
            [
                'question' => 'Hasil dari 125 ÷ 5 adalah ...',
                'option_a' => '20',
                'option_b' => '25',
                'option_c' => '15',
                'option_d' => '30',
                'option_e' => '35',
                'answer' => 'B',
            ],
			 // --- No 22  ------
            [
                'question' => 'Jika 5 buku harganya Rp100.000, maka harga 8 buku adalah ...',
                'option_a' => 'Rp. 100.0000',
                'option_b' => 'Rp 120.000',
                'option_c' => 'Rp. 140.000',
                'option_d' => 'Rp. 160.000',
                'option_e' => 'Rp. 180.000',
                'answer' => 'D',
            ],
			 // --- No 23  ------
            [
                'question' => 'Manakah kata yang tidak sesuai dengan yang lain? ...',
                'option_a' => 'Meja',
                'option_b' => 'kursi',
                'option_c' => 'sepatu',
                'option_d' => 'lemari',
                'option_e' => 'bangku',
                'answer' => 'C',
            ],
			 // --- No 24  ------
            [
                'question' => '5, 7, 11, 13, 17, 19, 23, ...',
                'option_a' => '25 , 27',
                'option_b' => '25 , 28',
                'option_c' => '25 , 29',
                'option_d' => '27 , 28',
                'option_e' => '25 , 30 ',
                'answer' => 'C',
            ],
			 // --- No 25  ------
            [
                'question' => 'Jika semua A adalah B, dan sebagian B adalah C, maka: ...',
                'option_a' => 'semua A adalah C',
                'option_b' => 'sebagian A adalah C',
                'option_c' => 'seluruh C adalah A',
                'option_d' => 'sebagian C adalah A',
                'option_e' => 'sebagain A adalah A',
                'answer' => 'B',
            ],
			 // --- No 26  ------
            [
                'question' => 'Satu mobil menempuh perjalanan 120 km dalam 2 jam. Jika kecepatannya tetap, berapa jarak yang ditempuh dalam 5 jam? ...',
                'option_a' => '200 Km',
                'option_b' => '250 Km',
                'option_c' => '300 Km',
                'option_d' => '350 Km',
                'option_e' => '400 Km',
                'answer' => 'C',
            ],
			 // --- No 27  ------
            [
                'question' => '3/4 + 1/2 = ...',
                'option_a' => '8/4',
                'option_b' => '5/4',
                'option_c' => '6/4',
                'option_d' => '7/4',
                'option_e' => '6/2',
                'answer' => 'B',
            ],
			 // --- No 28  ------
            [
                'question' => 'Suatu kereta melaju dengan kecepatan 60 km/jam. Berapa waktu yang diperlukan untuk menempuh jarak 180 km? ...',
                'option_a' => '2 Jam',
                'option_b' => '3 jam',
                'option_c' => '4 jam',
                'option_d' => '5 jam',
                'option_e' => '6 jam',
                'answer' => 'B',
            ],
			 // --- No 29  ------
            [
                'question' => 'Merdeka = ...',
                'option_a' => 'pesta',
                'option_b' => 'meluas',
                'option_c' => 'membeku',
                'option_d' => 'keliaran',
                'option_e' => 'bebas',
                'answer' => 'E',
            ],
			 // --- No 30  ------
            [
                'question' => 'Taraf = ...',
                'option_a' => 'jejak',
                'option_b' => 'cacat',
                'option_c' => 'Derajat',
                'option_d' => 'hidup',
                'option_e' => 'anggaran',
                'answer' => 'C',
            ],
			 // --- No 31  ------
            [
                'question' => 'Emas : Tambang || …… : .….',
                'option_a' => 'garam : logam',
                'option_b' => 'permata : perhiasan',
                'option_c' => 'kayu : pohon',
                'option_d' => 'pramuka : seragam',
                'option_e' => 'lidah : mulut',
                'answer' => 'C',
            ],
			 // --- No 32  ------
            [
                'question' => 'Motor : Roda || …. ; ….',
                'option_a' => 'Rumah : fondasi',
                'option_b' => 'Rumah : pintu',
                'option_c' => 'Baju : kancing',
                'option_d' => 'Buku : balpoin',
                'option_e' => 'Buku : lembar',
                'answer' => 'B',
            ],
			 // --- No 33  ------
            [
                'question' => 'Jarak antara kota X-Y adalah 360 km. Jika ditempuh dengan motor dengan kecepatan 90 km/jam, maka berapa lama perjalanan ditempuh? ...',
                'option_a' => '200 menit',
                'option_b' => '230 menit',
                'option_c' => '240 menit',
                'option_d' => '250 menit',
                'option_e' => '350 menit',
                'answer' => 'C',
            ],
			 // --- No 34  ------
            [
                'question' => 'Perbandingan uang jajan Abay dan uang jajan Fajri adalah 3:2. Jika uang Abay dan Fajri berjumlah Rp 150.000, berapakah masing-masing uang Abay dan Fajri? ...',
                'option_a' => 'Rp 80.000 dan Rp 60.000',
                'option_b' => 'Rp 90.000 dan Rp 60.000',
                'option_c' => 'Rp 90.000 dan Rp 70.000',
                'option_d' => 'Rp 90.000 dan Rp 80.000',
                'option_e' => 'Rp 95.000 dan Rp 75.000',
                'answer' => 'B',
            ],
			 // --- No 35  ------
            [
                'question' => 'Nilai tempat angka 7 pada bilangan 7.582 adalah ...',
                'option_a' => 'ratusan',
                'option_b' => 'ribuan',
                'option_c' => 'puluhan',
                'option_d' => 'satuan',
                'option_e' => 'puluh ribu',
                'answer' => 'B',
            ],
			 // --- No 36  ------
            [
                'question' => '4 3 8 6 16 12 ...',
                'option_a' => '32',
                'option_b' => '47',
                'option_c' => '48',
                'option_d' => '60',
                'option_e' => '78',
                'answer' => 'A',
            ],
			 // --- No 37  ------
            [
                'question' => 'Pilih jawaban yang benar',
                'option_a' => 'reporter',
                'option_b' => 'jurnalis',
                'option_c' => 'wartawan',
                'option_d' => 'editor',
                'option_e' => 'polisi',
                'answer' => 'E',
            ],
			 // --- No 38  ------
            [
                'question' => 'A, C, E, G, ..., ....',
                'option_a' => 'I , K',
                'option_b' => 'J , K',
                'option_c' => 'J , M',
                'option_d' => 'L , K',
                'option_e' => 'O , K',
                'answer' => 'A',
            ],
			 // --- No 39  ------
            [
                'question' => 'Semua polisi berbadan tegap. Sebagian polisi adalah polisi lalu lintas. Jadi:….?',
                'option_a' => 'Sebagian polisi lalu lintas berbadan tegap',
                'option_b' => 'Semua polisi pasti polisi lalu lintas',
                'option_c' => 'Ada polisi yang tidak berbadan tegap',
                'option_d' => 'Polisi lalu lintas pasti berbadan tegap',
                'option_e' => 'Polisi lalu lintas belum tentu berbadan tegap',
                'answer' => 'D',
            ],
			 // --- No 40  ------
            [
                'question' => 'Jarak kota Bungah dan Meranti adalah 280 km. Apabila ditempuh dengan kecepatan 40 km/ jam, maka waktu perjalanan yang ditempuh adalah? ...',
                'option_a' => '420 menit',
                'option_b' => '450 menit',
                'option_c' => '320 menit',
                'option_d' => '340 menit',
                'option_e' => '425 menit',
                'answer' => 'A',
            ],
			 // --- No 41  ------
            [
                'question' => 'Diana menyimpan uang di bank dan mendapatkan bunga sebesar 20% setiap tahunnya. Apabila uang tabungan Diana berjumlah Rp 150.000, maka setelah 1 tahun menabung di bank tersebut total uang tabungan Diana menjadi? ...',
                'option_a' => 'Rp 185.000',
                'option_b' => 'Rp 180.000',
                'option_c' => 'Rp 175.000',
                'option_d' => 'Rp 190.000',
                'option_e' => 'Rp 195.000',
                'answer' => 'B',
            ],
			 // --- No 42  ------
            [
                'question' => 'Tangkas >< ...',
                'option_a' => 'rajin',
                'option_b' => 'cepat',
                'option_c' => 'cekatan',
                'option_d' => 'gesit',
                'option_e' => 'lamban',
                'answer' => 'E',
            ],
			 // --- No 43  ------
            [
                'question' => '2, 4, 7, 11, 16, ..., ....',
                'option_a' => '17, 18',
                'option_b' => '20, 22',
                'option_c' => '22, 29',
                'option_d' => '24, 32',
                'option_e' => '29, 35',
                'answer' => 'C',
            ],
			 // --- No 44  ------
            [
                'question' => '5, 7, 11, 19, 35, ..., ...',
                'option_a' => '67, 131',
                'option_b' => '45, 120',
                'option_c' => '42, 110',
                'option_d' => '40, 100',
                'option_e' => '38, 95',
                'answer' => 'A',
            ],
			 // --- No 45  ------
            [
                'question' => '1, 3, 7, 13, 21,  ..., ...',
                'option_a' => '25',
                'option_b' => '28',
                'option_c' => '31',
                'option_d' => '35',
                'option_e' => '45',
                'answer' => 'C',
            ],
			 // --- No 46  ------
            [
                'question' => 'Pulau Komodo terletak di provinsi? ...',
                'option_a' => 'Bali',
                'option_b' => 'NTT',
                'option_c' => 'NTB',
                'option_d' => 'JATIM',
                'option_e' => 'SULAWESI SELATAN',
                'answer' => 'B',
            ],
			 // --- No 47  ------
            [
                'question' => 'Presiden RI yang dipilih oleh rakyat langsung pertama kali adalah ...',
                'option_a' => 'Soekarno',
                'option_b' => 'BJ Habibi',
                'option_c' => 'Gusdur',
                'option_d' => 'Megawati',
                'option_e' => 'Susilo Bambang Yudhoyono',
                'answer' => 'C',
            ],
			 // --- No 48  ------
            [
                'question' => 'Pemilu keberapa yang pertama kalinya rakyat memilih presiden dan wakil presiden secara langsung ?',
                'option_a' => '1999',
                'option_b' => '2004',
                'option_c' => '2009',
                'option_d' => '2014',
                'option_e' => '2019',
                'answer' => 'B',
            ],
			 // --- No 49  ------
            [
                'question' => ' Pada tanggal berapakah Hari Lahir Pancasila diperingati? ',
                'option_a' => '1 Juni',
                'option_b' => '1 Juli',
                'option_c' => '21 Juni',
                'option_d' => '21 Juli',
                'option_e' => '17 Juni',
                'answer' => 'A',
            ],
			 // --- No 50  ------
            [
                'question' => 'Apa nama mata uang dari negara Thailand?  ...',
                'option_a' => 'Won',
                'option_b' => 'Rupiah',
                'option_c' => 'Dollar',
                'option_d' => 'Yen',
                'option_e' => 'Bath',
                'answer' => 'E',
            ]
           
        ];

        // Tambahkan timestamp created_at & updated_at
        foreach ($questions as &$q) {
            $q['created_at'] = $now;
            $q['updated_at'] = $now;
        }

        // Masukkan semua data ke tabel 'questions'
        DB::table('questions')->insert($questions);
    }
}
