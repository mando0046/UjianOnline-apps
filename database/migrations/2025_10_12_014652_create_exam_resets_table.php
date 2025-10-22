<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exam_resets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // pending | approved | rejected
            $table->text('reason')->nullable(); // alasan pengajuan
            $table->text('admin_note')->nullable(); // catatan admin (opsional)
            $table->integer('allowed_attempts')->default(0); // jumlah izin ujian ulang
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_resets');
    }
};
