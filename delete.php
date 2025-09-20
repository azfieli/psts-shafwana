<?php
// Konfigurasi Database
$host = 'localhost';
$dbname = 'database_siswa';
$username = 'root';
$password = '';

// Membuat koneksi
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Ambil ID dari parameter URL
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Hapus data siswa
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
        $stmt->execute([$id]);
        
        header("Location: index.php?success=Data siswa berhasil dihapus");
        exit();
    } catch(PDOException $e) {
        header("Location: index.php?error=Gagal menghapus data: " . $e->getMessage());
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>