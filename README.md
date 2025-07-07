# 🎯 Guess Number Game (PHP + MySQL)

Game sederhana tebak angka dari 1–10, berbasis **PHP Native + MySQL**.  
Dirancang untuk latihan logika pemrograman dan sebagai portofolio mini-project.

## 🧩 Fitur Utama

- 🔐 Login & Register User
- 🎮 Mode "Best of 5"
- 📊 Statistik Menang / Kalah
- 🧠 Tracking angka tebakan paling sering dipilih
- 🏆 Leaderboard user dengan skor tertinggi
- 🧼 Reset skor (per user)
- 🌐 Multi-user support

## 🛠️ Teknologi

- **Frontend**: HTML, CSS
- **Backend**: PHP Native
- **Database**: MySQL
- **Visualisasi**: Chart.js (statistik angka tebakan)

## 🗂️ Struktur File

guess-game/
│
├── auth.php → Halaman login & register
├── index.php → Halaman utama permainan
├── db.php → Koneksi ke database
├── leaderboard.php → Tampilkan 10 user dengan skor tertinggi
├── logout.php → Logout dan destroy session
├── reset.php → Reset skor & sesi best-of-5
├── style.css → Tampilan modern dan clean
├── db.sql → Struktur database (users + game history)

## 🚀 Cara Menjalankan

1. Import `db.sql` ke **phpMyAdmin**
2. Pastikan `db.php` sesuai dengan koneksi lokal lo (`localhost`, `root`, dll)
3. Jalankan `auth.php` untuk login / register
4. Mainkan game dari `index.php`

## 👨‍💻 Dibuat Oleh

**Pandu Wiranata**  
Mini-project ini dibuat untuk latihan dan portofolio pengembangan aplikasi berbasis web.

## 📄 Lisensi

Bebas digunakan dan dimodifikasi untuk tujuan belajar dan pengembangan.
