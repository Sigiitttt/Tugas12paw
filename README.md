# 📚 Aplikasi CRUD Buku dengan PHP & MySQL

Proyek ini merupakan tugas mata kuliah **Pemrograman Sistem Database**, yang berfokus pada pembuatan aplikasi CRUD (Create, Read, Update, Delete) menggunakan **PHP prosedural** dan **MySQL**.
Aplikasi ini juga dilengkapi dengan fitur **unggah cover buku**, **pencarian (search)**, dan **paginasi (pagination)**.

---

<img width="1615" height="980" alt="image" src="https://github.com/user-attachments/assets/675ff5d1-a0ec-455a-bee2-3a0c7ff4b0ca" />


## 🚀 Demo Online

🌐 [tugas12paw.infinityfreeapp.com](https://tugas12paw.infinityfreeapp.com)

> *Jika belum bisa diakses, kemungkinan masih dalam proses propagasi DNS (maksimal 72 jam).*

---

## 🧩️ Fitur Utama

✅ **Tambah Buku** – Input data buku baru lengkap dengan cover.
✅ **Edit Buku** – Ubah informasi buku atau ganti cover.
✅ **Hapus Buku** – Menghapus data buku dari database dan file cover dari server.
✅ **Upload File** – Menyimpan cover buku di folder `/uploads/`.
✅ **Pencarian & Filter** – Cari buku berdasarkan judul atau genre.
✅ **Paginasi** – Menampilkan daftar buku per halaman agar tampilan tetap rapi.
✅ **Hosting Online** – Diterapkan menggunakan **InfinityFree** (hosting gratis).

---

## 🛠️ Teknologi yang Digunakan

* **Bahasa Pemrograman:** PHP 8.x (Prosedural)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3
* **Server Hosting:** InfinityFree (cPanel)
* **Text Editor:** Visual Studio Code

---

## 📂 Struktur Folder

```
htdocs/
├── index.php        # Halaman utama daftar buku
├── add.php          # Form tambah buku
├── edit.php         # Form edit buku
├── delete.php       # Menghapus buku
├── db.php           # Koneksi database
├── style.css        # Desain tampilan web
└── uploads/         # Folder penyimpanan file cover buku
```

---

## 🗄️ Struktur Database

### Tabel: `buku`

| Kolom        | Tipe Data      | Keterangan             |
| ------------ | -------------- | ---------------------- |
| id           | INT (Auto Inc) | Primary Key            |
| judul        | VARCHAR(255)   | Judul buku             |
| pengarang    | VARCHAR(255)   | Nama pengarang         |
| penerbit     | VARCHAR(255)   | Nama penerbit          |
| tahun_terbit | YEAR           | Tahun terbit buku      |
| harga        | DECIMAL(10,2)  | Harga buku             |
| genre        | VARCHAR(50)    | Genre buku (dropdown)  |
| cover        | VARCHAR(255)   | Nama file cover gambar |

