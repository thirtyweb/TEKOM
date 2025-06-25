# TEKOM

Repositori ini adalah proyek Laravel + Vite untuk kebutuhan web TEKOM. Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal.

## 1. Clone Repositori

```bash
git clone https://github.com/thirtyweb/TEKOM.git
cd TEKOM
```

> Gantilah URL di atas jika Anda melakukan fork repositori ini.

## 2. Instal Dependensi

### Backend (PHP)

```bash
composer install
```

### Frontend (JavaScript)

```bash
npm install
```

## 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian, buat kunci enkripsi aplikasi:

```bash
php artisan key:generate
```

## 4. Atur Koneksi Database

Edit file `.env` dan sesuaikan bagian berikut dengan konfigurasi database lokal Anda:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=user_database_anda
DB_PASSWORD=password_anda
```

## 5. Jalankan Migrasi Database

Jalankan perintah berikut untuk membuat tabel-tabel database:

```bash
php artisan migrate
```

Jika Anda ingin mengisi data awal (seeder), jalankan:

```bash
php artisan migrate --seed
```

## 6. Buat Symbolic Link untuk Storage

Agar file yang diunggah dapat diakses secara publik, jalankan:

```bash
php artisan storage:link
```

## 7. Kompilasi Aset Frontend

Untuk membangun aset CSS dan JavaScript:

```bash
npm run build
```

## 8. Menjalankan Proyek

### Backend (Laravel)

```bash
php artisan serve
```

Aplikasi dapat diakses di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Frontend (Vite Hot Reload - opsional)

Jika Anda ingin menggunakan hot reload saat mengembangkan frontend:

```bash
npm run dev
```

---

## Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).
