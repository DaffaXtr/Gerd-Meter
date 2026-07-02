<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PakarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            ['kode_gejala' => 'GRD01', 'nama_gejala' => 'Nyeri panas di ulu hati (Heartburn)', 'sifat_gejala' => 'GEJALA BERAT', 'bobot_skor' => 20],
            ['kode_gejala' => 'GRD02', 'nama_gejala' => 'Bau mulut', 'sifat_gejala' => 'GEJALA SEDANG', 'bobot_skor' => 13.3],
            ['kode_gejala' => 'GRD03', 'nama_gejala' => 'Mual', 'sifat_gejala' => 'GEJALA BIASA', 'bobot_skor' => 6.7],
            ['kode_gejala' => 'GRD04', 'nama_gejala' => 'Batuk kronis', 'sifat_gejala' => 'GEJALA BIASA', 'bobot_skor' => 6.7],
            ['kode_gejala' => 'GRD05', 'nama_gejala' => 'Rasa pahit di mulut (Regurgitasi)', 'sifat_gejala' => 'GEJALA SEDANG', 'bobot_skor' => 13.3],
            ['kode_gejala' => 'GRD06', 'nama_gejala' => 'Regurgitasi (asam lambung & makanan naik)', 'sifat_gejala' => 'GEJALA BERAT', 'bobot_skor' => 20],
            ['kode_gejala' => 'GRD07', 'nama_gejala' => 'Disfagia (kesulitan menelan)', 'sifat_gejala' => 'GEJALA BERAT', 'bobot_skor' => 20],
        ];

        foreach ($gejalas as $g) {
            \App\Models\Gejala::create($g);
        }

        $penyakits = [
            [
                'nama_penyakit' => 'GERD Ringan',
                'tingkat_keparahan' => 'Ringan (Skor 3-5)',
                'solusi_saran' => 'Sistem ini hanya sebagai pendeteksi dini. Hasil menunjukkan indikasi GERD Ringan. Pantau gejala Anda secara berkala, dan jika dirasa mengganggu atau memburuk, pertimbangkan untuk berkonsultasi dengan dokter.',
            ],
            [
                'nama_penyakit' => 'GERD Sedang',
                'tingkat_keparahan' => 'Sedang (Skor 6-9)',
                'solusi_saran' => 'Sistem ini hanya sebagai pendeteksi dini. Hasil menunjukkan indikasi GERD Sedang. Disarankan untuk berkonsultasi dengan dokter guna mendapatkan pemeriksaan dan penanganan yang tepat.',
            ],
            [
                'nama_penyakit' => 'GERD Berat',
                'tingkat_keparahan' => 'Berat (Skor >= 10)',
                'solusi_saran' => 'Sistem ini hanya sebagai pendeteksi dini. Hasil menunjukkan indikasi GERD Berat. Segera konsultasikan kondisi Anda ke Dokter Spesialis Penyakit Dalam (Gastroenterohepatologi) untuk penanganan medis lebih lanjut.',
            ],
        ];

        foreach ($penyakits as $p) {
            \App\Models\Penyakit::create($p);
        }
    }
}
