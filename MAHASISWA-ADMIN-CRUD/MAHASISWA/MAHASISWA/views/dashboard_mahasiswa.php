<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah login dan diterima sebagai mahasiswa

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'mahasiswa') {
    header("Location: loginregis.php"); // Redirect ke halaman login jika tidak berhak
    exit();
}
?>


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
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Selamat Datang di Dashboard Mahasiswa</h3>
        
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
            <h4>Menu Mahasiswa</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="profile.php">Lihat Profil</a>
                </li>
                <li class="list-group-item">
                    <a href="materi.php">Materi Perkuliahan</a>
                </li>
                <li class="list-group-item">
                    <a href="nilai.php">Cek Nilai</a>
                </li>
                <li class="list-group-item">
                    <a href="logout.php">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
