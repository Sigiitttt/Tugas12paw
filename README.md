# Tugas 12 - Pemrograman Aplikasi Web (PAW)

## 📌 Deskripsi Proyek

Proyek ini adalah aplikasi **CRUD sederhana berbasis PHP & MySQL** untuk mengelola data **Genre Film**. Aplikasi ini dibuat sebagai bagian dari Tugas 12 pada mata kuliah **Pemrograman Aplikasi Web (PAW)**.

## 🛠️ Teknologi yang Digunakan

* **Bahasa Pemrograman:** PHP (Native)
* **Database:** MySQL
* **Server:** InfinityFree (Free Hosting)
* **Frontend:** HTML, CSS, dan Bootstrap

## 📂 Struktur Folder

```
📁 tugas12paw/
│
├── konek.php              # Koneksi ke database
├── index.php              # Halaman utama menampilkan data genre
├── create.php             # Form untuk menambah data genre
├── update.php             # Form untuk mengedit data genre
├── delete.php             # Menghapus data genre
└── read.php               # Menampilkan daftar data genre
```

## 🧩 Fitur Utama

* Menampilkan daftar genre film.
* Menambah data genre baru.
* Mengedit data genre.
* Menghapus data genre.

## 💾 Struktur Database

Nama Database: **db_film**

### Tabel: `genre`

| Kolom | Tipe Data              | Keterangan      |
| ----- | ---------------------- | --------------- |
| id    | INT(11) AUTO_INCREMENT | Primary Key     |
| nama  | VARCHAR(100)           | Nama Genre Film |

---

**Catatan:** Pastikan file `konek.php` sudah disesuaikan dengan konfigurasi database kamu sebelum menjalankan aplikasi.
