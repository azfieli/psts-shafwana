# psts-shafwana

# CRUD Data Siswa (Penilaian Tengah Semester)

Proyek ini dibuat sebagai **Penilaian Tengah Semester (PTS) Student Day Programming Web**.  
Aplikasi ini adalah sistem sederhana untuk mengelola **data siswa** menggunakan PHP & MySQL.

---

## Apa itu CRUD?
CRUD adalah singkatan dari **Create, Read, Update, Delete**, yaitu operasi dasar yang biasanya ada dalam aplikasi yang berhubungan dengan database:

1. **Create (Tambah)** → menambahkan data baru ke database.  
2. **Read (Baca)** → menampilkan atau membaca data dari database.  
3. **Update (Edit)** → mengubah data yang sudah ada.  
4. **Delete (Hapus)** → menghapus data dari database.  

Di proyek ini, operasi CRUD diterapkan pada tabel `students`.

---

## Fitur
- Tambah data siswa (nama, jenis kelamin, tanggal lahir, kelas).  
- Menampilkan data dalam bentuk tabel.  
- Edit data siswa.  
- Hapus data siswa.  

---

## Struktur Database
Tabel `students` memiliki kolom:
- `id` (INT, Primary Key, Auto Increment)  
- `name` (VARCHAR)  
- `gender` (ENUM: 'Laki-laki', 'Perempuan')  
- `birth_date` (DATE)  
- `kelas` (VARCHAR)  

---

## Cara Menjalankan
1. Import file `crud_siswa.sql` ke database MySQL melalui **phpMyAdmin** atau jalankan `install.php`.  
2. Jalankan XAMPP (Apache & MySQL).  
3. Simpan folder project ke `htdocs`.  
4. Akses lewat browser:  
