@extends('layouts.app')
@section('title', 'Kuesioner Medis')

@section('content')
<div class="max-w-2xl mx-auto py-8 sm:py-16 md:py-24 px-4 sm:px-8 w-full">
    <!-- Progress Bar -->
    <div class="mb-8 sm:mb-16">
        <div class="flex justify-between text-sm font-bold text-primary mb-4 px-2">
            <span>Progres Pemeriksaan</span>
            <span id="progress-text">0%</span>
        </div>
        <div class="w-full bg-primary/10 rounded-full h-3 overflow-hidden shadow-inner">
            <div id="progress-bar" class="bg-primary h-3 rounded-full transition-all duration-700 ease-out relative" style="width: 0%">
                <div class="absolute top-0 right-0 bottom-0 left-0 bg-white/20" style="animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></div>
            </div>
        </div>
    </div>

    <!-- Container Kuesioner -->
    <div id="question-container" class="bg-white rounded-3xl shadow-md border border-surface-container-high/60 overflow-hidden transition-all duration-300 transform translate-y-4 opacity-0 relative min-h-[380px] sm:min-h-[400px] flex flex-col group">
        <!-- Loading State -->
        <div id="loading-state" class="absolute inset-0 bg-white/70 z-20 flex items-center justify-center backdrop-blur-sm">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary/20 border-t-primary"></div>
        </div>

        <div class="grow flex flex-col p-8 sm:p-10 lg:p-12 relative z-10 justify-between">
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-primary/5 rounded-bl-[100px] -mr-10 -mt-10 z-0 pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-start">
                <span id="kode-gejala" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-primary/10 text-primary text-xs font-bold rounded-full border border-primary/20 mb-6 tracking-wider">
                    <span class="material-symbols-outlined text-[14px]">medication</span>
                    G01
                </span>
                
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-deep-forest leading-snug mb-8" id="nama-gejala">
                    <!-- Pertanyaan muncul di sini -->
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 relative z-10 mt-8">
                <button onclick="submitAnswer(true)" class="group w-full py-4 px-6 bg-primary text-white rounded-full font-bold text-base transition-all duration-300 shadow-md shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-4 focus:ring-primary/20 flex items-center justify-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined transition-transform group-hover:scale-105">check_circle</span>
                    YA, SAYA MENGALAMI
                </button>
                <button onclick="submitAnswer(false)" class="group w-full py-4 px-6 bg-white text-muted-green rounded-full font-bold text-base transition-all duration-300 border border-surface-container-high hover:border-red-200 hover:text-red-500 hover:bg-red-50/50 hover:-translate-y-0.5 active:scale-95 focus:outline-none focus:ring-4 focus:ring-red-100 flex items-center justify-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined transition-transform group-hover:scale-105">cancel</span>
                    TIDAK
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentGejala = null;
    const loadingState = document.getElementById('loading-state');
    const questionContainer = document.getElementById('question-container');
    const namaGejalaEl = document.getElementById('nama-gejala');
    const kodeGejalaEl = document.getElementById('kode-gejala');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    document.addEventListener('DOMContentLoaded', () => {
        // Tampilkan container dengan animasi
        setTimeout(() => {
            questionContainer.classList.remove('translate-y-4', 'opacity-0');
            questionContainer.classList.add('translate-y-0', 'opacity-100');
        }, 100);
        
        loadNextQuestion();
    });

    async function loadNextQuestion() {
        loadingState.classList.remove('hidden');
        questionContainer.classList.add('opacity-50');
        
        try {
            const response = await fetch('/api/question', {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            
            if (data.finished) {
                window.location.href = data.redirect;
                return;
            }

            // Update UI
            setTimeout(() => {
                currentGejala = data.gejala;
                namaGejalaEl.textContent = "Apakah Anda mengalami " + currentGejala.nama_gejala.toLowerCase() + "?";
                kodeGejalaEl.textContent = currentGejala.kode_gejala;
                
                progressBar.style.width = data.progress + '%';
                progressText.textContent = data.progress + '%';
                
                const btns = document.querySelector('.mt-auto.grid');
                if (btns) {
                    const newBtns = btns.cloneNode(true);
                    btns.parentNode.replaceChild(newBtns, btns);
                }

                loadingState.classList.add('hidden');
                questionContainer.classList.remove('opacity-50');
            }, 400); // Simulasi delay animasi
            
        } catch (error) {
            console.error('Error fetching question:', error);
            alert('Terjadi kesalahan koneksi. Silakan muat ulang halaman.');
        }
    }

    async function submitAnswer(jawaban) {
        if (!currentGejala) return;
        
        if (document.activeElement) {
            document.activeElement.blur();
        }
        
        loadingState.classList.remove('hidden');
        questionContainer.classList.add('opacity-50');

        try {
            const response = await fetch('/api/answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    kode_gejala: currentGejala.kode_gejala,
                    jawaban: jawaban
                })
            });
            
            const data = await response.json();
            
            if (data.finished) {
                window.location.href = data.redirect;
            } else {
                loadNextQuestion();
            }
        } catch (error) {
            console.error('Error submitting answer:', error);
            loadingState.classList.add('hidden');
            questionContainer.classList.remove('opacity-50');
        }
    }
</script>
@endpush
