@extends('layouts.app')
@section('title', 'Cek Risiko Lambung Anda')

@section('content')
<!-- Main Hero Section -->
<main id="home" class="relative py-8 lg:py-20 overflow-hidden hero-gradient flex flex-col justify-center min-h-[80vh] lg:min-h-[760px]">
    <div class="max-w-[1400px] mx-auto px-4 md:px-10 lg:px-12 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
        <!-- Left Side: Content (45%) -->
        <div class="lg:col-span-5 space-y-10 z-20 lg:pr-8">
            <div class="space-y-6 text-center lg:text-left flex flex-col items-center lg:items-start">
                <h1 class="font-headline-display font-bold text-headline-display text-deep-forest leading-[1.1]">
                    Cek Risiko GERD dalam <span class="text-primary-container">2 Menit</span>
                </h1>
                <p class="text-body-md font-normal text-muted-green max-w-[448px]">
                    GERD Meter membantu Anda mengevaluasi risiko GERD secara cepat, akurat, dan personal melalui sistem pakar berbasis gejala.
                </p>
            </div>
            <div class="flex flex-col gap-4 items-center lg:items-start text-center lg:text-left">
                <form action="{{ route('start') }}" method="POST" class="w-fit">
                    @csrf
                    <button type="submit" class="w-fit flex items-center gap-3 bg-primary-container text-white pl-8 pr-2 py-2 rounded-full font-label-sm font-medium text-lg transition-colors duration-300 hover:bg-forest-green shadow-lg shadow-primary/20 group">
                        Mulai Screening Sekarang
                        <span class="bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-transform">
                            <span class="material-symbols-outlined text-white">arrow_forward</span>
                        </span>
                    </button>
                </form>
                <div class="flex items-center gap-2 text-label-sm font-medium text-muted-green/80 lg:ml-2 mb-4">
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                    <span class="">Tanpa login • 100% Privasi Terjamin</span>
                </div>

                <!-- Mini Feature Bar -->
                <div class="bg-white/60 backdrop-blur-md rounded-2xl shadow-sm border border-white/50 p-6 flex flex-wrap gap-6 w-full">
                    <!-- Feature 1 -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-primary-container/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[24px]">schedule</span>
                        </div>
                        <div class="text-left">
                            <h4 class="font-bold text-base text-deep-forest mb-0.5 leading-none">2 Menit</h4>
                            <p class="text-xs font-medium text-muted-green leading-tight">Pemeriksaan cepat</p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-primary-container/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[24px]">target</span>
                        </div>
                        <div class="text-left">
                            <h4 class="font-bold text-base text-deep-forest mb-0.5 leading-none">Akurat</h4>
                            <p class="text-xs font-medium text-muted-green leading-tight">Backward Chaining</p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-primary-container/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[24px]">verified_user</span>
                        </div>
                        <div class="text-left">
                            <h4 class="font-bold text-base text-deep-forest mb-0.5 leading-none">Aman</h4>
                            <p class="text-xs font-medium text-muted-green leading-tight">Data terlindungi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Visual (55%) -->
        <div class="hidden lg:flex lg:col-span-7 relative h-[400px] md:h-[500px] items-center justify-center">
            <!-- Main Visual Composition Wrapper -->
            <div class="relative w-full h-full flex items-center justify-center">
                <!-- New Primary Background Asset -->
                <div class="absolute inset-0 flex items-center justify-center z-0 pointer-events-none">
                    <img src="/images/aset hero.svg" alt="GERD Healthy Food" class="w-full max-w-full h-auto object-contain opacity-90">
                </div>

                <!-- Floating Badge (Preserved) -->
                <div class="absolute top-[50%] md:top-[25%] left-0 md:left-[5%] lg:-left-4 glass-card p-4 rounded-xl shadow-lg flex items-center gap-3 z-20">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
                    </div>
                    <div>
                        <p class="text-label-sm font-bold text-deep-forest leading-none">Aman</p>
                        <p class="text-[10px] text-muted-green">Terpercaya &amp; Personal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- About Section -->
<section id="about" class="py-8 lg:py-24 relative overflow-hidden bg-white">
    <div class="max-w-[1400px] mx-auto px-4 md:px-10 lg:px-12 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-20">
            <span class="text-primary font-bold tracking-wider uppercase text-sm mb-4 block">Tentang GERD</span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-deep-forest mb-6 leading-tight">Mengenal Penyakit Asam Lambung</h2>
            <p class="text-muted-green text-base md:text-lg">
                Gastroesophageal Reflux Disease (GERD) adalah kondisi medis di mana asam lambung naik kembali ke kerongkongan, mengiritasi lapisan saluran cerna dan dapat sangat mengganggu aktivitas harian.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Left: Description & Info -->
            <div class="space-y-8">
                <div class="bg-primary/5 rounded-3xl p-8 border border-primary/10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-bl-[100px] -mr-8 -mt-8 z-0"></div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-deep-forest mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">info</span>
                            Mengapa Deteksi Dini Penting?
                        </h3>
                        <p class="text-muted-green leading-relaxed mb-4">
                            Jika dibiarkan tanpa penanganan, GERD tidak hanya menyebabkan rasa tidak nyaman sesaat (seperti panas di dada). Dalam jangka panjang, kondisi ini bisa memicu komplikasi serius seperti peradangan, tukak, penyempitan kerongkongan, hingga meningkatkan risiko kanker esofagus.
                        </p>
                        <p class="text-muted-green leading-relaxed">
                            Oleh karena itu, mengenali gejala secara dini dan melakukan evaluasi (seperti screening melalui GERDMeter) adalah langkah krusial untuk mencegah perburukan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Symptoms Grid -->
            <div>
                <h3 class="text-2xl font-bold text-deep-forest mb-8">Gejala Umum GERD</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Symptom Card 1 -->
                    <div class="group">
                    <div class="bg-white p-6 rounded-2xl shadow-sm shadow-black/5 border border-surface-container-high hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">local_fire_department</span>
                        </div>
                        <h4 class="font-bold text-deep-forest mb-2">Heartburn</h4>
                        <p class="text-sm text-muted-green">Sensasi dada terbakar atau panas yang sering terjadi setelah makan atau saat berbaring.</p>
                    </div>
                    </div>
                    <!-- Symptom Card 2 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm shadow-black/5 border border-surface-container-high hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">sick</span>
                        </div>
                        <h4 class="font-bold text-deep-forest mb-2">Mual & Muntah</h4>
                        <p class="text-sm text-muted-green">Rasa ingin muntah, mulut terasa asam/pahit, terutama di pagi hari.</p>
                    </div>
                    <!-- Symptom Card 3 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm shadow-black/5 border border-surface-container-high hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">air</span>
                        </div>
                        <h4 class="font-bold text-deep-forest mb-2">Sesak Napas / Batuk</h4>
                        <p class="text-sm text-muted-green">Asam lambung yang mengiritasi saluran pernapasan sering memicu batuk kering kronis.</p>
                    </div>
                    <!-- Symptom Card 4 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm shadow-black/5 border border-surface-container-high hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">restaurant</span>
                        </div>
                        <h4 class="font-bold text-deep-forest mb-2">Sulit Menelan</h4>
                        <p class="text-sm text-muted-green">Dikenal sebagai disfagia, yaitu munculnya sensasi makanan tersangkut di tenggorokan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Steps Section -->
<section id="steps" class="py-8 lg:py-24 bg-surface relative">
    <div class="max-w-[1400px] mx-auto px-4 md:px-10 lg:px-12">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-20">
            <span class="text-primary font-bold tracking-wider uppercase text-sm mb-4 block">Cara Kerja</span>
            <h2 class="text-3xl md:text-4xl font-bold text-deep-forest mb-6">Diagnosis Pintar dalam 4 Langkah</h2>
            <p class="text-muted-green text-base md:text-lg">
                GERDMeter menggunakan sistem pakar dengan metode <strong>Backward Chaining</strong>. Sistem akan melacak gejala-gejala yang Anda alami untuk menarik kesimpulan dan tingkat risiko secara akurat layaknya konsultasi dokter.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            <!-- Step 1 -->
            <div class="bg-white rounded-3xl p-8 border border-surface-container-high relative overflow-hidden group hover:border-primary/30 transition-colors shadow-sm hover:shadow-md">
                <div class="absolute -top-6 -right-4 text-[120px] font-black text-primary/5 group-hover:text-primary/10 transition-colors pointer-events-none leading-none">1</div>
                <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 relative z-10">
                    <span class="material-symbols-outlined text-[28px]">person_add</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3 relative z-10">Isi Data Diri</h4>
                <p class="text-muted-green text-sm relative z-10">
                    Masukkan data dasar Anda tanpa perlu membuat akun panjang. Keamanan dan privasi data terjamin.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-3xl p-8 border border-surface-container-high relative overflow-hidden group hover:border-primary/30 transition-colors shadow-sm hover:shadow-md lg:translate-y-4">
                <div class="absolute -top-6 -right-4 text-[120px] font-black text-primary/5 group-hover:text-primary/10 transition-colors pointer-events-none leading-none">2</div>
                <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 relative z-10">
                    <span class="material-symbols-outlined text-[28px]">quiz</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3 relative z-10">Evaluasi Gejala</h4>
                <p class="text-muted-green text-sm relative z-10">
                    Jawab pertanyaan singkat seputar kondisi Anda dengan mengklik "Ya" atau "Tidak" sesuai keluhan.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-3xl p-8 border border-surface-container-high relative overflow-hidden group hover:border-primary/30 transition-colors shadow-sm hover:shadow-md lg:translate-y-8">
                <div class="absolute -top-6 -right-4 text-[120px] font-black text-primary/5 group-hover:text-primary/10 transition-colors pointer-events-none leading-none">3</div>
                <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 relative z-10">
                    <span class="material-symbols-outlined text-[28px]">memory</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3 relative z-10">Analisis Pakar</h4>
                <p class="text-muted-green text-sm relative z-10">
                    Sistem bekerja mencocokkan gejala menggunakan rantai mundur (Backward Chaining) dengan basis pengetahuan medis.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-3xl p-8 border border-surface-container-high relative overflow-hidden group hover:border-primary/30 transition-colors shadow-sm hover:shadow-md lg:translate-y-12">
                <div class="absolute -top-6 -right-4 text-[120px] font-black text-primary/5 group-hover:text-primary/10 transition-colors pointer-events-none leading-none">4</div>
                <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 relative z-10">
                    <span class="material-symbols-outlined text-[28px]">assignment_turned_in</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3 relative z-10">Terima Hasil</h4>
                <p class="text-muted-green text-sm relative z-10">
                    Dapatkan kesimpulan seketika mengenai tingkat risiko Anda beserta rekomendasi penanganan awal.
                </p>
            </div>
        </div>

        <!-- Call to Action button bottom -->
        <div class="mt-16 text-center lg:mt-32 flex justify-center">
            <form action="{{ route('start') }}" method="POST">
                @csrf
                <button type="submit" class="w-fit flex items-center gap-3 bg-primary-container text-white pl-8 pr-2 py-2 rounded-full font-label-sm font-medium text-lg transition-colors duration-300 hover:bg-forest-green shadow-lg shadow-primary/20 group">
                    Mulai Konsultasi Sekarang
                    <span class="bg-white/20 w-10 h-10 rounded-full flex items-center justify-center transition-transform">
                        <span class="material-symbols-outlined text-white">arrow_forward</span>
                    </span>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Tips Section -->
<section id="tips" class="py-8 lg:py-24 relative bg-white border-t border-surface-container-high">
    <div class="max-w-[1400px] mx-auto px-4 md:px-10 lg:px-12 w-full">
        <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end gap-8 mb-12 lg:mb-16">
            <div class="max-w-2xl text-center lg:text-left">
                <span class="text-primary font-bold tracking-wider uppercase text-sm mb-4 block">Tips Kesehatan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-deep-forest mb-4">Gaya Hidup Ramah Lambung</h2>
                <p class="text-muted-green text-base md:text-lg">
                    Perubahan kecil pada rutinitas dan pola makan harian Anda dapat memberikan dampak besar dalam mencegah naiknya asam lambung.
                </p>
            </div>
            <div class="pb-2">
                <a href="#" class="text-primary font-bold hover:text-forest-green flex items-center justify-center gap-2 group transition-colors">
                    Lihat Semua Tips
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Tip 1 -->
            <div class="bg-surface rounded-3xl p-8 border border-surface-container-high hover:border-primary/30 transition-colors group shadow-sm hover:shadow-md">
                <div class="w-16 h-16 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[32px]">set_meal</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3">Makan Porsi Kecil tapi Sering</h4>
                <p class="text-muted-green text-sm leading-relaxed">
                    Menghindari porsi makan yang terlalu besar dapat mencegah lambung menjadi terlalu penuh, yang mengurangi tekanan pada katup kerongkongan bagian bawah.
                </p>
            </div>

            <!-- Tip 2 -->
            <div class="bg-surface rounded-3xl p-8 border border-surface-container-high hover:border-primary/30 transition-colors group shadow-sm hover:shadow-md">
                <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[32px]">airline_seat_flat_angled</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3">Jangan Langsung Berbaring</h4>
                <p class="text-muted-green text-sm leading-relaxed">
                    Berikan jeda minimal 2 hingga 3 jam setelah makan sebelum Anda tidur atau berbaring santai untuk memastikan makanan turun dengan baik.
                </p>
            </div>

            <!-- Tip 3 -->
            <div class="bg-surface rounded-3xl p-8 border border-surface-container-high hover:border-primary/30 transition-colors group shadow-sm hover:shadow-md">
                <div class="w-16 h-16 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[32px]">local_cafe</span>
                </div>
                <h4 class="text-xl font-bold text-deep-forest mb-3">Hindari Pemicu Asam</h4>
                <p class="text-muted-green text-sm leading-relaxed">
                    Kurangi konsumsi kopi, alkohol, cokelat, makanan sangat pedas, serta makanan berlemak tinggi yang dapat memicu relaksasi katup lambung.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
