<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'guest', 'peserta'])->default('guest');
            $table->rememberToken();
            $table->timestamps();
        });

        // Soal ujian
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('option_a')->default('');
            $table->string('option_b')->default('');
            $table->string('option_c')->default('');
            $table->string('option_d')->default('');
            $table->string('option_e')->default(''); // 🔹 boleh kosong kalau soal cuma 4 opsi
            $table->string('answer'); // contoh: 'a'
            $table->timestamps();
        });

        // Jawaban peserta
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->string('answer');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('users');
    }
};
