<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'SP2D', 'SPM', 'SPBy', 'SPP', 'SSP',
            'FORM PERMINTAAN', 'SURAT TUGAS', 'SPD DAN BUKTI VISUM',
            'PRESENSI DAN UANG MAKAN', 'SURAT PERNYATAAN', 'LAPORAN PERJADIN',
            'DAFTAR RILL', 'DAFTAR GAJI', 'UNDANGAN', 'DRPP', 'KAK',
            'BERITA ACARA', 'RINCIAN PERJADIN', 'SPJ', 'SK KPA',
            'BUKTI PEMBAYARAN', 'DAFTAR REKAP', 'LAINNYA'
        ];

        foreach ($categories as $category) {
            DB::table('kategoris')->insert([
                'nama' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
