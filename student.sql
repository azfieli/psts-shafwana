-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS database_siswa;
USE database_siswa;

-- Buat tabel students
CREATE TABLE students (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    gender ENUM('L', 'P') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO students (nama, gender, tanggal_lahir) VALUES
('Ahmad Rizki', 'L', '2005-03-15'),
('Siti Rahayu', 'P', '2006-07-22'),
('Budi Santoso', 'L', '2005-11-08'),
('Dewi Lestari', 'P', '2004-09-30'),
('Rudi Hermawan', 'L', '2005-12-25');