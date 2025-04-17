# 🧾 Aplikasi Kasir Laravel 7

Aplikasi kasir sederhana berbasis Laravel 7 yang mendukung dua role pengguna (Admin dan Kasir). Aplikasi ini membantu proses transaksi penjualan, pengelolaan produk dan pelanggan, serta pencatatan riwayat penjualan.

---

## 📌 Fitur Utama

- ✅ Manajemen Data Produk
- ✅ Manajemen Data Pelanggan
- ✅ Transaksi Penjualan (dengan detail produk)
- ✅ Login multi-role (Admin & Kasir)
- ✅ Kode Transaksi Unik
- ✅ Seeder Admin Default
- ✅ Relasi antar tabel dengan foreign key
- 🔜 (Opsional) Cetak struk, export PDF, laporan penjualan

---

## 🗂 Struktur Tabel Utama

### 1. `pelanggans`
Menyimpan informasi pelanggan:
- `PelangganID`, `Nama_pelanggan`, `Alamat`, `Nomor_telepon`

### 2. `produks`
Menyimpan data produk:
- `ProdukID`, `Nama_Produk`, `Harga`, `Stok`, `Deskripsi`, `Gambar`

### 3. `penjualans`
Mencatat transaksi penjualan:
- `PenjualanID`, `Tanggal_Penjualan`, `Total_Harga`, `PelangganID`, `Kode_Transaksi`

### 4. `detail_penjualans`
Mencatat detail barang yang dijual per transaksi:
- `DetailPenjualanID`, `PenjualanID`, `ProdukID`, `Jumlah_produk`, `Subtotal`

---

## 🔐 Role Pengguna

| Role   | Akses                                                                 |
|--------|-----------------------------------------------------------------------|
| Admin  | Kelola semua data (produk, pelanggan, penjualan, user)               |
| Kasir  | Hanya bisa melakukan transaksi dan melihat daftar produk              |

---

## 🚀 Instalasi

1. **Clone repository**
```bash
git clone https://github.com/username/nama-project.git
cd nama-project

--cara install--
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve


Email | Password | Role
admin@gmail.com | admin | Admin

--Teknologi--
Laravel 7
MySQL
Blade Template
Bootstrap/CSS


