<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah login dan diterima sebagai mahasiswa
if (!isset($_SESSION['username']) || $_SESSION['status_pendaftaran'] !== 'Diterima') {
    header("Location: login.php");
    exit();
}

// Ambil informasi nilai mahasiswa berdasarkan nomor tes yang ada di session
$nomor_tes = $_SESSION['nomor_tes'];
$query = $conn->prepare("SELECT * FROM hasil_tes WHERE nomor_tes = :nomor_tes");
$query->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
$query->execute();
$nilai = $query->fetch(PDO::FETCH_ASSOC);

// Pastikan data nilai ditemukan
if (!$nilai) {
    echo "Data nilai tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Cek Nilai</h3>
        
        <div class="card">
            <div class="card-header">
                Hasil Tes
            </div>
            <div class="card-body">
                <p><strong>Nomor Tes:</strong> <?php echo htmlspecialchars($nilai['nomor_tes']); ?></p>
                <p><strong>Nilai Tes:</strong> <?php echo htmlspecialchars($nilai['nilai_tes']); ?></p>
                <p><strong>Status Lulus:</strong> <?php echo htmlspecialchars($nilai['status_lulus']); ?></p>
            </div>
        </div>

        <div class="mt-4">
            <a href="dashboard_mahasiswa.php" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
