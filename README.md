# JANJI
Saya Khalifa Nabil Nur dengan NIM 2511372 mengerjakan Tugas Praktikum 8 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program & Database
Aplikasi ini mengimplementasikan pola arsitektur **Model-View-Controller (MVC)** untuk sistem manajemen akademik dengan 3 tabel yang saling berelasi pada database `tp_mvc25`:

1. **`departments`**
   - **Atribut**: `id` (Primary Key), `dept_name`, `faculty`.
   - **Fungsi**: Menyimpan daftar program studi/jurusan.
2. **`lecturers`**
   - **Atribut**: `id` (Primary Key), `name`, `nidn`, `phone`, `join_date`, `department_id` (Foreign Key).
   - **Relasi**: *Many-to-One* ke tabel `departments` melalui `department_id`.
3. **`courses`** 
   - **Atribut**: `id` (Primary Key), `course_code`, `course_name`, `credits`, `lecturer_id` (Foreign Key).
   - **Relasi**: *Many-to-One* ke tabel `lecturers` melalui `lecturer_id` (dosen pengampu mata kuliah).

## Penjelasan Alur Program (Arsitektur MVC)

1. **Request & Entry Point (`index.php`, `course.php`, `department.php`)**
   - Pengguna mengakses halaman atau mengirimkan form (`GET` / `POST`).
   - File *entry point* menangkap parameter request (seperti `?add=1`, `?edit=id`, `?delete=id`, `$_POST['submit']`, atau `$_POST['update']`) dan memanggil method yang sesuai pada **Controller**.
2. **Controller (`controllers/`)**
   - `LecturerController`, `CourseController`, dan `DepartmentController` bertugas menjadi penghubung antara **Model** dan **View**.
   - Controller meminta data dari Model, memproses aksi tambah/ubah/hapus data, lalu mengirimkan data hasil olahan ke View atau melakukan *redirect* setelah operasi tulis selesai.
3. **Model (`models/`)**
   - Kelas `Lecturer`, `Course`, dan `Department` mewarisi kelas dasar `DB` untuk membuka koneksi ke MySQL.
   - Model menjalankan query SQL (`SELECT`, `INSERT`, `UPDATE`, `DELETE`) dengan *prepared statements* serta mengambil data relasi menggunakan `JOIN`.
4. **View & Template (`views/` & `templates/`)**
   - `LecturerView`, `CourseView`, dan `DepartmentView` menerima data array dari Controller, menyusun baris tabel HTML atau opsi `<select>` relasi, lalu menyuntikkannya ke kerangka HTML (`templates/*.html` dan `skin.html`) menggunakan kelas `Template` untuk ditampilkan ke browser.
  
## DOKUMENTASI
