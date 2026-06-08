# Planning Project: GERD Meter (Sistem Pakar Backward Chaining & Skoring)

Dokumen perencanaan ini dibuat sebagai panduan utama dalam pengembangan aplikasi web sistem pakar diagnosis tingkat keparahan GERD tanpa fitur login.

---

## 1. Penjelasan Umum Project

**GERD Meter** adalah aplikasi web sistem pakar (*expert system*) interaktif yang berfungsi untuk mengukur dan mendiagnosis tingkat keparahan penyakit *Gastroesophageal Reflux Disease* (GERD) pada pengguna. 

Aplikasi ini ditujukan untuk memberikan pre-diagnosis atau edukasi kesehatan awal secara cepat. Pengguna tidak perlu melakukan pendaftaran akun atau login (tanpa autentikasi) sehingga dapat langsung melakukan pengecekan secara instan melalui serangkaian kuesioner dinamis.

---

## 2. Arsitektur Sistem & Spesifikasi Teknologi

Sistem dirancang secara monolitik yang efisien dan responsif menggunakan arsitektur MVC (*Model-View-Controller*).

### Tech Stack
* **Backend Framework:** Laravel 11+ (PHP 8.3+)
* **Frontend Styling:** Tailwind CSS v4.0+ (via Vite/Laravel Mix)
* **Database:** MySQL / MariaDB
* **State & Session Management:** Native Laravel Session / HTTP Session

### Mengapa Laravel & Tailwind?
* **Laravel:** Memiliki sistem ORM (Eloquent) yang kuat untuk memetakan basis pengetahuan (*knowledge base*) dari database, serta penanganan *routing* dan *session* temporer yang sangat aman meskipun tanpa sistem login.
* **Tailwind CSS:** Memungkinkan pembuatan antarmuka kuesioner satu per satu (*wizard step*) yang bersih, modern, dan sangat responsif di perangkat *mobile* (karena mayoritas pengguna medis mengakses via ponsel).

---

## 3. Logika & Mekanisme Inferensi (Mesin Inferensi)

Aplikasi ini menggabungkan dua metode kecerdasan buatan tradisional: **Backward Chaining (Penalaran Mundur)** untuk menentukan validasi penyakit, dan **Scoring System (Sistem Skoring)** untuk menentukan tingkat keparahan klinis.

### A. Klasifikasi Bobot Skor Gejala
Gejala dibagi menjadi dua kelompok besar berdasarkan tingkat validitas klinisnya terhadap GERD:

| Kode Gejala | Nama Gejala | Sifat Gejala | Skor |
| :--- | :--- | :--- | :--- |
| **GRD01** | Nyeri panas di ulu hati (*Heartburn*) | Khas (Tipikal) | **3** |
| **GRD05** | Rasa pahit di mulut (*Regurgitasi*) | Khas (Tipikal) | **3** |
| **GRD08** | Terbangun di malam hari | Atipikal (Berat) | **3** |
| **GRD04** | Batuk Kronis | Atipikal (Sedang)| **2** |
| **GRD07** | Muntah | Atipikal (Sedang)| **2** |
| **GRD02** | Bau mulut | Atipikal (Ringan)| **1** |
| **GRD03** | Mual | Atipikal (Ringan)| **1** |
| **GRD06** | Kembung | Atipikal (Ringan)| **1** |

### B. Aturan Logika (*Rule Base*) Backward Chaining
Sistem menetapkan **Goal = GERD**. Evaluasi bergerak mundur dari *Goal* memeriksa kebenaran fakta:

1.  **Rule 1 (Validasi Dasar):** * `IF` (GRD01 == TRUE) `OR` (GRD05 == TRUE) ➔ `THEN` Status = **POSITIF GERD**.
    * *Logika Mundur:* Sistem wajib menanyakan dua gejala khas ini di awal sesi. Jika salah satu bernilai TRUE, rantai penalaran berlanjut ke pengumpulan skor gejala atipikal.
2.  **Rule 2 (Kondisi Terminasi Dini):** * `IF` (GRD01 == FALSE) `AND` (GRD05 == FALSE) ➔ `THEN` Status = **BUKAN GERD**.
    * *Logika Mundur:* Jika pada tahap awal pengguna menjawab "Tidak" untuk kedua gejala khas, mesin inferensi akan memotong jalur (*shortcut*), menghentikan kuesioner, dan langsung mengarahkan pengguna ke halaman hasil BUKAN GERD.

### C. Penentuan Tingkat Keparahan (Threshold)
Jika pengguna dinyatakan POSITIF GERD (memenuhi Rule 1), maka tingkat keparahan ditentukan dari akumulasi nilai `total_skor`:
* **GERD Ringan:** Total Skor `3 - 5`
* **GERD Sedang:** Total Skor `6 - 9`
* **GERD Berat:** Total Skor `>= 10`

---

## 4. Struktur Database (Schema)

Meskipun tanpa fitur login, database digunakan untuk menyimpan *Knowledge Base* (aturan statis) dan mencatat riwayat diagnosis global secara anonim untuk keperluan statistik sistem.

+------------------+         +--------------------+         +-----------------------+
|     gejalas      |         |      penyakits     |         |      konsultasis      |
+------------------+         +--------------------+         +-----------------------+
| id (PK)          |         | id (PK)            |         | id (PK)               |
| kode_gejala (UC) |         | nama_penyakit      |         | session_token         |
| nama_gejala      |         | tingkat_keparahan  |         | total_skor            |
| sifat_gejala     |         | solusi_saran       |         | hasil_diagnosis       |
| bobot_skor       |         +--------------------+         | created_at            |
+------------------+                                        +-----------------------+

### rincian Migrasi Laravel:
1.  **Table `gejalas`:** Menyimpan master data 8 gejala beserta nilai bobot skornya.
2.  **Table `penyakits`:** Menyimpan variasi output hasil (`GERD Ringan`, `GERD Sedang`, `GERD Berat`).
3.  **Table `konsultasis`:** Menyimpan log transaksi anonim yang mengikat `session_token` dari browser pengguna (berguna untuk mencegah data hilang saat *refresh* halaman).

---

## 5. Rencana Pengembangan Antarmuka (UI/UX)

Aplikasi akan diimplementasikan dalam struktur halaman yang *seamless*:

1.  **Halaman Beranda (`/`):** * Tampilan bersih dengan ilustrasi anatomi lambung.
    * Tombol ajakan bertindak (CTA) berukuran besar dengan animasi Tailwind (`transition-all duration-300 transform hover:scale-105`).
2.  **Halaman Kuesioner (`/diagnose`):**
    * Menggunakan komponen kartu interaktif tunggal yang berganti secara asinkronus (bisa memanfaatkan AJAX / Livewire atau manipulasi DOM Session Laravel).
    * Tombol opsi pilihan ganda besar: `[ YA ]` berwarna hijau mendominasi, dan `[ TIDAK ]` berwarna merah/abu-abu lembut.
3.  **Halaman Hasil (`/result/{token}`):**
    * Visualisasi grafis tingkat keparahan menggunakan diagram meteran (*gauge meter chart*) menggunakan Tailwind progress bar.
    * Diferensiasi warna dinamis: Hijau (Bukan GERD), Kuning (Ringan), Oranye (Sedang), Merah (Berat/Kronis).

---

## 6. Alur Kerja Kode Program (Implementation Steps)

1.  **Tahap 1:** Inisialisasi proyek Laravel dan instalasi Tailwind CSS via Vite.
2.  **Tahap 2:** Membuat *Database Migration* dan *Seeder* untuk data gejala statis dan rules.
3.  **Tahap 3:** Pembuatan `DiagnosisController` untuk mengatur alur *session* dan logika *backward chaining*.
4.  **Tahap 4:** Slicing UI Beranda dan Kuesioner menggunakan komponen-komponen utilitas Tailwind.
5.  **Tahap 5:** Pengujian Logika Sistem (Memastikan *shortcut* berjalan ketika `GRD01` dan `GRD05` bernilai `FALSE`).