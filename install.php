<?php
// Konfigurasi Database
$host = 'localhost';
$username = 'root';
$password = '';

// Membuat koneksi tanpa memilih database
try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Membuat database jika belum ada
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS database_siswa");
    $pdo->exec("USE database_siswa");
    
    // Membuat tabel students
    $pdo->exec("CREATE TABLE IF NOT EXISTS students (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(100) NOT NULL,
        gender ENUM('L', 'P') NOT NULL,
        tanggal_lahir DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    
    // Menambahkan data contoh
    $pdo->exec("INSERT IGNORE INTO students (nama, gender, tanggal_lahir) VALUES
        ('Ahmad Rizki', 'L', '2005-03-15'),
        ('Siti Rahayu', 'P', '2006-07-22'),
        ('Budi Santoso', 'L', '2005-11-08'),
        ('Dewi Lestari', 'P', '2004-09-30'),
        ('Rudi Hermawan', 'L', '2005-12-25')");
    
    header("Location: index.php?success=Database berhasil diinstall dengan data contoh");
    exit();
} catch(PDOException $e) {
    die("Error installing database: " . $e->getMessage());
}
?>