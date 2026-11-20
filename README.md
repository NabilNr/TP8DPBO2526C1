# JANJI
Saya Khalifa Nabil Nur dengan NIM 2511372 mengerjakan Tugas Praktikum 8 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program & Database
Aplikasi ini mengimplementasikan pola arsitektur **Model-View-Controller (MVC)** untuk sistem manajemen akademik dengan 3 tabel yang saling berelasi pada database `tp_mvc25`:

1. **`departments`** *(Tabel Baru 1)*
   - **Atribut**: `id` (Primary Key), `dept_name`, `faculty`.
   - **Fungsi**: Menyimpan daftar program studi/jurusan.
2. **`lecturers`** *(Tabel Utama — Dimodifikasi)*
   - **Atribut**: `id` (Primary Key), `name`, `nidn`, `phone`, `join_date`, `department_id` (Foreign Key).
   - **Relasi**: *Many-to-One* ke tabel `departments` melalui `department_id`.
3. **`courses`** *(Tabel Baru 2)*
   - **Atribut**: `id` (Primary Key), `course_code`, `course_name`, `credits`, `lecturer_id` (Foreign Key).
   - **Relasi**: *Many-to-One* ke tabel `lecturers` melalui `lecturer_id` (dosen pengampu mata kuliah).
