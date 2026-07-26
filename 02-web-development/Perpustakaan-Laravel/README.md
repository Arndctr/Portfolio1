# Sistem Informasi Perpustakaan Digital — SMP Negeri 12 Yogyakarta


**Tools:** Laravel, Livewire, MySQL, Laravel Excel
**Jenis:** Penelitian Dosen (terdaftar HAKI) — Universitas Negeri Yogyakarta

> Dikembangkan sebagai bagian dari penelitian dosen dan telah terdaftar HAKI. Dikerjakan bersama tim.

## 📌 Latar Belakang
Pengelolaan peminjaman buku dan data anggota di perpustakaan sekolah masih manual, sehingga sulit dipantau dan rawan kehilangan data.

## 🔧 Fitur Utama
- **Admin:** dashboard statistik, manajemen anggota (+ export Excel), manajemen buku, approval peminjaman dengan pengingat otomatis, broadcast pengumuman
- **User (Siswa/Guru):** setup akun dengan verifikasi email, peminjaman buku daring, riwayat peminjaman, kelola profil

## 🛠️ Proses Pengerjaan
- Merancang database anggota, buku, dan transaksi peminjaman
- Membangun fitur CRUD real-time dengan Livewire
- Integrasi notifikasi email otomatis (verifikasi akun & pengingat jatuh tempo)
- Export data anggota ke Excel dengan Laravel Excel

