<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\PakarSeeder;

class DiagnosisTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PakarSeeder::class);
    }

    public function test_shortcut_bukan_gerd()
    {
        $this->post('/start')->assertRedirect('/diagnose');
        
        $this->postJson('/api/answer', ['kode_gejala' => 'GRD01', 'jawaban' => false]);
        $res = $this->postJson('/api/answer', ['kode_gejala' => 'GRD05', 'jawaban' => false]);
        
        $res->assertJson(['finished' => true]);
        
        $token = session('diagnosis_token');
        $this->assertDatabaseHas('konsultasis', [
            'session_token' => $token,
            'hasil_diagnosis' => 'Bukan GERD'
        ]);
    }

    public function test_skoring_gerd_berat()
    {
        $this->post('/start');
        
        $urutan = ['GRD01', 'GRD05', 'GRD08', 'GRD04', 'GRD07', 'GRD02', 'GRD03', 'GRD06'];
        $res = null;
        foreach ($urutan as $kode) {
            $res = $this->postJson('/api/answer', ['kode_gejala' => $kode, 'jawaban' => true]);
        }
        
        $res->assertJson(['finished' => true]);
        
        $token = session('diagnosis_token');
        $this->assertDatabaseHas('konsultasis', [
            'session_token' => $token,
            'hasil_diagnosis' => 'GERD Berat'
        ]);
    }
}
