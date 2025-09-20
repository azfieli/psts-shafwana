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

// Query untuk mengambil data siswa
try {
    $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Jika tabel belum ada, buat tabel
    if ($e->getCode() == '42S02') {
        $students = [];
    } else {
        die("Error mengambil data: " . $e->getMessage());
    }
}

// Fungsi untuk menampilkan pesan
function showMessage() {
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo $_GET['success'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $_GET['error'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Siswa - PTS Web Programming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .page-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .table-responsive {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="text-center">CRUD Data Siswa</h1>
            <p class="text-center">Penilaian Tengah Semester - Student Day Programming Web</p>
        </div>
        
        <?php showMessage(); ?>

        <div class="d-flex justify-content-between mb-3">
            <a href="create.php" class="btn btn-primary">Tambah Siswa</a>
            <a href="install.php" class="btn btn-outline-secondary">Install Database</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Tanggal Lahir</th>
                        <th>Usia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($students) > 0): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($student['nama']); ?></td>
                                <td>
                                    <?php if ($student['gender'] == 'L'): ?>
                                        <span class="badge bg-primary">Laki-laki</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Perempuan</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d-m-Y', strtotime($student['tanggal_lahir'])); ?></td>
                                <td>
                                    <?php
                                    $birthDate = new DateTime($student['tanggal_lahir']);
                                    $today = new DateTime();
                                    $age = $today->diff($birthDate)->y;
                                    echo $age . ' tahun';
                                    ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data siswa ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <h4>Data siswa belum tersedia</h4>
                                    <p>Silakan install database terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <footer class="mt-5 text-center text-muted">
            <p>&copy; 2025 Student Day Programming Web - Penilaian Tengah Semester</p>
        </footer>
    </div>

    <a href="install.php" class="btn btn-outline-secondary">Install Database</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>