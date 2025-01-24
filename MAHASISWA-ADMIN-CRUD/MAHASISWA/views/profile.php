<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah login dan diterima sebagai mahasiswa
if (!isset($_SESSION['username']) || $_SESSION['status_pendaftaran'] !== 'Diterima') {
    header("Location: login.php");
    exit();
}

// Ambil informasi mahasiswa berdasarkan NIM yang ada di session
$nim = $_SESSION['nim'];
$query = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
$query->bindParam(':nim', $nim, PDO::PARAM_STR);
$query->execute();
$mahasiswa = $query->fetch(PDO::FETCH_ASSOC);

// Pastikan data mahasiswa ditemukan
if (!$mahasiswa) {
    echo "Data mahasiswa tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Profile Mahasiswa</h3>
        
        <div class="card">
            <div class="card-header">
                Informasi Mahasiswa
            </div>
            <div class="card-body">
                <p><strong>NIM:</strong> <?php echo htmlspecialchars($mahasiswa['nim']); ?></p>
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($mahasiswa['nama']); ?></p>
                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($mahasiswa['alamat']); ?></p>
                <p><strong>Nomor Handphone:</strong> <?php echo htmlspecialchars($mahasiswa['nomor_handphone']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($mahasiswa['username']); ?></p>
                <p><strong>Status Pendaftaran:</strong> <?php echo htmlspecialchars($_SESSION['status_pendaftaran']); ?></p>
            </div>
        </div>

        <div class="mt-4">
            <a href="dashboard_mahasiswa.php" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
