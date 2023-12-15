<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_absens', function (Blueprint $table) {
            $table->id();
            $table->string('chatId')->unique();
            $table->string('UrlAbsen')->nullable();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('password')->nullable();
            $table->text('koordinat')->nullable();
            $table->string('device')->nullable();
            $table->string('Agent')->nullable();
            $table->string('token')->nullable();
            $table->integer('saldo')->nullable();
            $table->string('status')->nullable();
            $table->text('aksi_terakhir')->nullable();
            $table->text('pesan_terakhir')->nullable();
            $table->text('work_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_absens');
    }
};
