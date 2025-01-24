<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data pendaftar dari database
$query_pendaftar = $conn->prepare("SELECT * FROM calon_mahasiswa WHERE status_pendaftaran != 'Daftar Ulang'");
$query_pendaftar->execute();
$pendaftar_list = $query_pendaftar->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>List Pendaftar</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor Tes</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor HP</th>
                    <th>Status Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendaftar_list as $pendaftar): ?>
                    <tr>
                        <td><?= htmlspecialchars($pendaftar['nomor_tes']) ?></td>
                        <td><?= htmlspecialchars($pendaftar['nama']) ?></td>
                        <td><?= htmlspecialchars($pendaftar['alamat']) ?></td>
                        <td><?= htmlspecialchars($pendaftar['nomor_handphone']) ?></td>
                        <td><?= htmlspecialchars($pendaftar['status_pendaftaran']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
