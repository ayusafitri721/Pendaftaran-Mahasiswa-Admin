<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah login dan diterima sebagai mahasiswa
if (!isset($_SESSION['username']) || $_SESSION['status_pendaftaran'] !== 'Diterima') {
    header("Location: login.php");
    exit();
}

// Ambil data materi perkuliahan
$query = $conn->prepare("SELECT * FROM materi_perkuliahan");
$query->execute();
$materi = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Perkuliahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Materi Perkuliahan</h3>
        
        <div class="list-group">
            <?php foreach ($materi as $item): ?>
                <a href="materi_detail.php?id=<?php echo $item['id']; ?>" class="list-group-item list-group-item-action">
                    <?php echo htmlspecialchars($item['judul']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <a href="dashboard_mahasiswa.php" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
