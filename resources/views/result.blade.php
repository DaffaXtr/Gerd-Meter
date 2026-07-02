@extends('layouts.app')
@section('title', 'Hasil Screening')

@section('content')
<div class="max-w-[1400px] mx-auto px-4 md:px-8 lg:px-12 py-8 lg:py-16 w-full">
    <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-shadow border border-surface-container-high overflow-hidden relative">
        
        @php
            $isBukanGerd = $konsultasi->hasil_diagnosis === 'Bukan GERD';
            
            // Tentukan warna berdasarkan hasil
            $colorClass = 'text-slate-600';
            $bgClass = 'bg-slate-500';
            $lightBgClass = 'bg-slate-50';
            $borderClass = 'border-surface-container-high';
            $icon = '<span class="material-symbols-outlined text-[64px]">help</span>';
            $gaugeWidth = '0%';
            
            if ($isBukanGerd) {
                $colorClass = 'text-emerald-600';
                $bgClass = 'bg-emerald-500';
                $lightBgClass = 'bg-emerald-50/50';
                $borderClass = 'border-emerald-100';
                $icon = '<span class="material-symbols-outlined text-[64px]">check_circle</span>';
                $gaugeWidth = '10%'; // Gauge minimal
            } elseif ($konsultasi->hasil_diagnosis === 'GERD Ringan') {
                $colorClass = 'text-amber-500';
                $bgClass = 'bg-amber-400';
                $lightBgClass = 'bg-amber-50/50';
                $borderClass = 'border-amber-100';
                $icon = '<span class="material-symbols-outlined text-[64px]">warning</span>';
                $gaugeWidth = '40%';
            } elseif ($konsultasi->hasil_diagnosis === 'GERD Sedang') {
                $colorClass = 'text-orange-500';
                $bgClass = 'bg-orange-500';
                $lightBgClass = 'bg-orange-50/50';
                $borderClass = 'border-orange-100';
                $icon = '<span class="material-symbols-outlined text-[64px]">error</span>';
                $gaugeWidth = '70%';
            } elseif ($konsultasi->hasil_diagnosis === 'GERD Berat') {
                $colorClass = 'text-rose-600';
                $bgClass = 'bg-rose-600';
                $lightBgClass = 'bg-rose-50/50';
                $borderClass = 'border-rose-100';
                $icon = '<span class="material-symbols-outlined text-[64px]">dangerous</span>';
                $gaugeWidth = '100%';
            }
        @endphp

        <!-- Header Hasil -->
        <div class="px-8 py-12 text-center {{ $lightBgClass }} border-b {{ $borderClass }} relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 {{ $bgClass }} opacity-5 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 {{ $bgClass }} opacity-5 rounded-full blur-2xl"></div>

            <div class="inline-flex justify-center items-center mb-6 {{ $colorClass }} relative z-10 animate-bounce-slight">
                <span class="text-7xl sm:text-8xl font-black tracking-tight drop-shadow-sm">{{ str_replace('.', ',', rtrim(rtrim(number_format($konsultasi->total_skor, 1, '.', ''), '0'), '.')) }}</span>
            </div>
            <p class="text-xs font-bold text-muted-green uppercase tracking-[0.2em] mb-2 relative z-10">Kesimpulan Diagnosis Awal</p>
            <h2 class="text-3xl sm:text-4xl font-black {{ $colorClass }} relative z-10">{{ $konsultasi->hasil_diagnosis }}</h2>
        </div>

        <div class="p-8 sm:p-12 relative z-10 bg-white">
            <!-- Gauge Meter Keparahan -->
            <div class="mb-12">
                <div class="flex justify-between text-xs font-bold text-muted-green mb-4 px-2">
                    <span>Aman</span>
                    <span>Ringan</span>
                    <span>Sedang</span>
                    <span>Berat</span>
                </div>
                <div class="w-full bg-surface rounded-full h-4 overflow-hidden flex shadow-inner border border-surface-container-high">
                    <div class="h-full {{ $bgClass }} transition-all duration-1000 ease-out rounded-full shadow-[inset_0_-2px_4px_rgba(0,0,0,0.2)]" style="width: {{ $gaugeWidth }}"></div>
                </div>
            </div>

            <!-- Rekomendasi / Edukasi -->
            <div class="bg-surface rounded-3xl p-8 border border-surface-container-high relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-bl-full -mr-4 -mt-4 z-0 pointer-events-none"></div>
                
                <h3 class="text-xl font-bold text-deep-forest mb-4 flex items-center gap-2 relative z-10">
                    <span class="material-symbols-outlined text-primary">health_and_safety</span>
                    Tindak Lanjut & Edukasi
                </h3>
                
                <div class="relative z-10">
                    @if($isBukanGerd)
                        <div class="text-muted-green leading-relaxed space-y-4">
                            <p>Kabar baik! Berdasarkan jawaban Anda pada kuesioner awal, Anda <strong class="text-deep-forest">tidak menunjukkan gejala khas</strong> dari penyakit asam lambung (GERD) seperti nyeri panas di dada (heartburn) atau regurgitasi asam.</p>
                            <p>Namun, jika Anda masih merasakan ketidaknyamanan pada perut, ini bisa disebabkan oleh faktor lain seperti dispepsia (sakit maag biasa), masuk angin, atau intoleransi makanan tertentu.</p>
                            <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 p-6 rounded-2xl mt-8 text-sm">
                                <strong class="flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-[18px]">verified</span> Tips Menjaga Pencernaan:</strong>
                                <ul class="list-disc pl-5 space-y-1.5 opacity-90">
                                    <li>Makan secara teratur dengan porsi yang pas.</li>
                                    <li>Hindari stres berlebihan.</li>
                                    <li>Minum air putih minimal 8 gelas sehari.</li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <p class="text-muted-green leading-relaxed mb-6 text-base">
                            {{ $penyakit->solusi_saran ?? 'Segera konsultasikan keluhan Anda lebih lanjut dengan dokter profesional.' }}
                        </p>
                        <div class="bg-amber-50 border border-amber-200 text-amber-900 p-6 rounded-2xl text-sm flex gap-4 items-start">
                            <span class="material-symbols-outlined text-amber-600 shrink-0 mt-0.5">info</span>
                            <div>
                                <strong class="block mb-1">Penting Diketahui:</strong> 
                                Hasil ini hanya sebagai pendeteksi dini (Screening) dan <strong class="underline">bukan diagnosis medis mutlak</strong>. 
                                @if($konsultasi->hasil_diagnosis === 'GERD Berat')
                                    <span class="block mt-2 font-bold text-red-600">Karena hasil deteksi dini menunjukkan indikasi GERD Berat, segeralah mengunjungi dokter spesialis terkait.</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-white bg-primary hover:bg-forest-green rounded-full transition-all shadow-lg shadow-primary/20 hover:-translate-y-1 gap-2">
                    <span class="material-symbols-outlined text-[18px]">refresh</span>
                    Lakukan Screening Ulang
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    @keyframes bounce-slight {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-bounce-slight {
        animation: bounce-slight 3s ease-in-out infinite;
    }
</style>
@endsection
