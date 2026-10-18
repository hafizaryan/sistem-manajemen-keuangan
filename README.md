# Sistem Manajemen Keuangan

Sistem Manajemen Keuangan adalah aplikasi berbasis web yang dibangun dengan PHP natif dan database MySQL untuk membantu pencatatan serta pengelolaan keuangan. Aplikasi ini mencatat transaksi pemasukan dan pengeluaran, mengelola hutang dan piutang, serta menghasilkan laporan keuangan per periode.

## Fitur

- **Login multi level**: dua level pengguna, yaitu administrator dan manajemen, dengan halaman dashboard terpisah.
- **Pencatatan transaksi**: transaksi tunai (cash), BCA, dan BSI, lengkap dengan kategori transaksi.
- **Manajemen kategori**: tambah, ubah, dan hapus kategori pemasukan dan pengeluaran.
- **Hutang dan piutang**: pencatatan serta pelacakan hutang dan piutang.
- **Data bank**: pengelolaan data rekening bank (khusus administrator).
- **Manajemen pengguna**: tambah, ubah, dan hapus pengguna (khusus administrator).
- **Laporan keuangan**: laporan per periode yang dapat dicetak (print) dan diekspor ke PDF.
- **Ganti password**: setiap pengguna dapat mengubah kata sandinya sendiri.

## Teknologi

- PHP natif (tanpa framework) dengan ekstensi MySQLi
- MySQL atau MariaDB sebagai database
- Template AdminLTE (Bootstrap dan jQuery) untuk antarmuka
- DomPDF melalui folder `library/` untuk pembuatan laporan PDF

## Struktur Folder

- `index.php` - halaman login
- `periksa_login.php` - proses pemeriksaan login
- `koneksi.php` - konfigurasi koneksi database
- `database/project_keuangan.sql` - skema dan data awal database `project_keuangan`
- `admin/` - halaman dan proses untuk level administrator
- `manajemen/` - halaman dan proses untuk level manajemen
- `assets/` - aset AdminLTE (CSS, JavaScript, plugin)
- `gambar/` - berkas gambar aplikasi
- `library/` - pustaka pihak ketiga

## Persyaratan Sistem

- Server web Apache atau Nginx
- PHP versi 7.x atau lebih tinggi
- MySQL atau MariaDB

## Cara Menjalankan

1. Salin folder proyek ke direktori web server (misalnya `htdocs` pada XAMPP).
2. Buat database bernama `project_keuangan`, lalu impor berkas `database/project_keuangan.sql`.
3. Sesuaikan konfigurasi koneksi pada berkas `koneksi.php` (host, username, password, dan nama database).
4. Buka aplikasi melalui browser, contohnya `http://localhost/sistem-manajemen-keuangan`.

## Akun Awal

Akun awal tersedia setelah impor database (periksa data awal pada berkas SQL). Segera ubah kata sandi semua akun awal sebelum aplikasi dipakai di lingkungan nyata, dan jangan menuliskan kredensial pada dokumentasi publik.

## Lisensi

MIT, lihat berkas `LICENSE`.
