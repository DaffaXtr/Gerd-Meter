<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Konsultasi;

class DiagnosisController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function start(Request $request)
    {
        // Inisialisasi sesi baru
        $token = Str::random(32);
        $request->session()->put('diagnosis_token', $token);
        $request->session()->put('answers', []);
        $request->session()->put('current_index', 0);
        $request->session()->put('total_skor', 0);
        
        // Buat record awal konsultasi
        Konsultasi::create([
            'session_token' => $token,
            'total_skor' => 0
        ]);

        return redirect()->route('diagnose');
    }

    public function diagnose(Request $request)
    {
        if (!$request->session()->has('diagnosis_token')) {
            return redirect()->route('home');
        }
        return view('diagnose');
    }

    public function getQuestion(Request $request)
    {
        $currentIndex = $request->session()->get('current_index', 0);
        
        // Urutan 7 gejala baru: GRD01 hingga GRD07
        $urutan = ['GRD01', 'GRD02', 'GRD03', 'GRD04', 'GRD05', 'GRD06', 'GRD07'];

        if ($currentIndex >= count($urutan)) {
            return response()->json(['finished' => true, 'redirect' => route('result', ['token' => $request->session()->get('diagnosis_token')])]);
        }

        $kodeGejala = $urutan[$currentIndex];
        $gejala = Gejala::where('kode_gejala', $kodeGejala)->first();

        return response()->json([
            'finished' => false,
            'gejala' => $gejala,
            'progress' => round(($currentIndex / count($urutan)) * 100)
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|string',
            'jawaban' => 'required|boolean'
        ]);

        $kode = $request->kodeGejala;
        $jawaban = $request->jawaban;
        
        $answers = $request->session()->get('answers', []);
        $answers[$request->kode_gejala] = $jawaban;
        $request->session()->put('answers', $answers);

        // Tambah skor jika YA
        if ($jawaban) {
            $gejala = Gejala::where('kode_gejala', $request->kode_gejala)->first();
            if ($gejala) {
                $total = $request->session()->get('total_skor', 0) + $gejala->bobot_skor;
                $request->session()->put('total_skor', $total);
            }
        }

        $currentIndex = $request->session()->get('current_index', 0);
        $request->session()->put('current_index', $currentIndex + 1);

        // Hapus blok terminasi dini (Backward Chaining Rule shortcut)

        // Jika pertanyaan habis
        $urutan = ['GRD01', 'GRD02', 'GRD03', 'GRD04', 'GRD05', 'GRD06', 'GRD07'];
        if (($currentIndex + 1) >= count($urutan)) {
            $token = $request->session()->get('diagnosis_token');
            $totalSkor = $request->session()->get('total_skor');
            
            // Penentuan Keparahan
            $hasil = '';
            
            // Tahap A: Validasi Penyakit
            $grd01 = isset($answers['GRD01']) ? $answers['GRD01'] : false;
            $grd06 = isset($answers['GRD06']) ? $answers['GRD06'] : false;

            if ($grd01 == false && $grd06 == false) {
                // Rule 2: Bukan GERD
                $hasil = 'Bukan GERD';
            } else {
                // Rule 1: Positif GERD -> Tahap B: Keparahan
                if ($totalSkor > 60) {
                    $hasil = 'GERD Berat'; // Rule 5
                } elseif ($totalSkor > 35 && $totalSkor <= 60) {
                    $hasil = 'GERD Sedang'; // Rule 4
                } else {
                    $hasil = 'GERD Ringan'; // Rule 3 (20 - 35)
                }
            }

            Konsultasi::where('session_token', $token)->update([
                'hasil_diagnosis' => $hasil,
                'total_skor' => $totalSkor
            ]);

            return response()->json(['finished' => true, 'redirect' => route('result', ['token' => $token])]);
        }

        return response()->json(['success' => true]);
    }

    public function result($token)
    {
        $konsultasi = Konsultasi::where('session_token', $token)->firstOrFail();
        
        $penyakit = null;
        if ($konsultasi->hasil_diagnosis != 'Bukan GERD') {
            $penyakit = Penyakit::where('nama_penyakit', $konsultasi->hasil_diagnosis)->first();
        }

        return view('result', compact('konsultasi', 'penyakit'));
    }
}
