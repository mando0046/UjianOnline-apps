<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('exam_results', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->integer('total_soal')->default(0);
    $table->integer('benar')->default(0);
    $table->integer('salah')->default(0);
    $table->integer('kosong')->default(0);
    $table->decimal('nilai', 5, 2)->default(0);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('exam_reset_requests');
    }
};
