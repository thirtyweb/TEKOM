# Website Profil Departemen TEKOM

Selamat datang di repositori kode untuk website resmi Departemen Teknologi Rekayasa Komputer (TEKOM). Proyek ini dibangun menggunakan **Laravel** dan **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, Livewire) untuk memberikan pengalaman pengguna yang modern, interaktif, dan cepat.

## Fitur Utama

Berdasarkan struktur kode, proyek ini memiliki beberapa fitur utama:
* **Manajemen Konten**: Sistem artikel/berita dengan dukungan kategori, detail artikel, dan artikel terkait.
* **Galeri Foto**: Album foto kegiatan yang dapat menampilkan gambar dalam ukuran penuh (modal/lightbox).
* **Kurikulum Interaktif**: Tabel daftar mata kuliah yang dapat diurutkan (sorting) dan disaring (filtering) secara dinamis.
* **Pusat Sumber Daya**: Halaman untuk mengelola dan menyediakan file/dokumen yang dapat diunduh oleh pengguna.
* **Halaman FAQ**: Halaman tanya jawab untuk memberikan informasi umum kepada pengunjung.
* **Komponen Dinamis**: Penggunaan Livewire untuk komponen interaktif seperti slideshow, tabel, dan form tanpa perlu me-refresh halaman.

## Persyaratan Sistem

Sebelum melanjutkan proses instalasi, pastikan sistem Anda telah memenuhi persyaratan berikut:

* PHP (versi 8.1 atau yang lebih baru direkomendasikan)
* Composer (untuk manajemen dependensi PHP)
* Node.js & NPM (untuk manajemen dependensi frontend)
* Database Server (contoh: MySQL, MariaDB, atau PostgreSQL)

## Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di komputer Anda.

**1. Clone Repositori**

Pertama, clone repositori ini ke direktori lokal Anda melalui terminal.

```bash
git clone [https://github.com/username-anda/nama-repositori.git](https://github.com/username-anda/nama-repositori.git)
cd nama-repositori

Ganti username-anda/nama-repositori dengan URL repositori Anda.

2. Instal Dependensi

Instal semua dependensi yang dibutuhkan oleh proyek, baik untuk backend (PHP) maupun frontend (JavaScript).

# Instal dependensi PHP
composer install

# Instal dependensi JavaScript
npm install

3. Konfigurasi Environment

Salin file .env.example menjadi .env. File ini akan digunakan untuk menyimpan semua konfigurasi sensitif proyek Anda.

cp .env.example .env

Setelah itu, buat kunci enkripsi unik untuk aplikasi Anda.

php artisan key:generate

4. Atur Koneksi Database

Buka file .env dan sesuaikan konfigurasi database berikut dengan pengaturan di sistem lokal Anda.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=user_database_anda
DB_PASSWORD=password_anda

5. Jalankan Migrasi Database

Buat semua tabel yang dibutuhkan oleh aplikasi di dalam database Anda dengan menjalankan perintah migrasi.

php artisan migrate

Opsional: Jika proyek Anda memiliki data awal (database seeder), jalankan php artisan migrate --seed.

6. Buat Symbolic Link untuk Storage

Perintah ini sangat penting untuk membuat file yang diunggah (seperti gambar artikel, galeri, dan avatar) dapat diakses secara publik dari web.

php artisan storage:link

7. Kompilasi Aset Frontend

Proyek ini menggunakan Vite untuk mengelola aset frontend. Jalankan perintah berikut untuk mengkompilasi file CSS dan JavaScript.

npm run build

Menjalankan Proyek
Setelah semua langkah instalasi selesai, Anda dapat menjalankan server pengembangan lokal.

php artisan serve

Aplikasi Anda kini dapat diakses melalui browser di alamat http://127.0.0.1:8000.

Untuk pengembangan frontend secara real-time (dengan hot-reload), Anda dapat menjalankan perintah berikut di terminal terpisah:

npm run dev
