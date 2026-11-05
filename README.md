# 📚 OwlPost Library System

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

**OwlPost** adalah aplikasi manajemen perpustakaan digital berbasis web yang dirancang untuk memudahkan pengguna dalam menjelajahi, memilih, dan meminjam buku secara online, serta membantu administrator dalam mengelola inventaris buku, kategori, penulis, dan riwayat peminjaman.

---

## 🚀 Fitur Utama Aplikasi

### 👨‍💻 **Fitur User / Peminjam**
* **Autentikasi & Profil Pengguna:**
  * Registrasi dan login akun.
  * Setup nama dan foto profil saat pertama kali mendaftar.
  * Pengaturan & pembaruan profil pengguna (nama, email, foto profil, dan kata sandi).
* **Katalog Buku & Pencarian:**
  * Penjelajahan buku berdasarkan *New Arrivals*, *Most Borrowed*, dan *Favorite Books*.
  * Fitur pencarian buku berdasarkan judul secara *real-time*.
  * Filter buku berdasarkan Kategori, Penulis (*Author*), Genre, dan Tipe Buku.
* **Keranjang Peminjaman & Checkout:**
  * Menambahkan buku pilihan ke keranjang peminjaman (*Cart*).
  * Mengatur dan menghapus daftar keranjang.
  * Checkout peminjaman buku.
* **Manajemen Peminjaman (My Borrowings):**
  * Memantau status peminjaman buku aktif.
  * Riwayat peminjaman dan pengembalian buku secara mandiri.

### 🛡️ **Fitur Admin / Pengelola**
* **Manajemen Pengguna (User Management):**
  * Kelola data peminjam dan administrator.
* **Manajemen Katalog (CRUD Master Data):**
  * Kelola data Buku (*Books*).
  * Kelola data Penulis (*Authors*).
  * Kelola data Kategori (*Categories*).
  * Kelola data Genre (*Genres*).
  * Kelola data Tipe Buku (*Book Types*).
  * Kelola data Penerbit (*Publishers*).
* **Manajemen Peminjaman (Borrowing Management):**
  * Memantau dan mengelola seluruh transaksi peminjaman pengguna.
  * Mengubah status peminjaman dan tanggal pengembalian.

---

## 🛠️ Teknologi yang Digunakan

* **Backend Framework:** Laravel (PHP)
* **Frontend UI:** Blade Templating, Tailwind CSS
* **Database:** MySQL / MariaDB
* **Web Server:** Laragon / Apache

---