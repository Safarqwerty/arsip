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
        Schema::create('finance_documents', function (Blueprint $table) {
            $table->id();
            $table->string('kode_arsip')->unique(); // Kode arsip
            $table->string('nama_arsip');          // Nama arsip
            $table->string('kategori');            // Kategori (SP2D, SPM, dll.)
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->string('file_path');           // Lokasi file di server
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();                  // Waktu pembuatan & pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_documents');
    }
};
