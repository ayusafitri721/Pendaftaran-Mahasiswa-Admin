<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah lulus tes
if (!isset($_SESSION['username']) || $_SESSION['status_pendaftaran'] !== 'Lulus Tes') {
    exit();
}

$nomor_tes = $_SESSION['nomor_tes'];  

// Jika daftar ulang dilakukan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate Nomor Induk Mahasiswa (NIM)
    $nim = "NIM" . str_pad(rand(1, 99999), 5, "0", STR_PAD_LEFT);

    // Pindahkan data ke tabel mahasiswa
    $query_mahasiswa = $conn->prepare("
        INSERT INTO mahasiswa (nim, nama, alamat, nomor_handphone, username)
        SELECT :nim, nama, alamat, nomor_handphone, username
        FROM calon_mahasiswa WHERE nomor_tes = :nomor_tes
    ");
    $query_mahasiswa->bindParam(':nim', $nim, PDO::PARAM_STR);
    $query_mahasiswa->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
    $query_mahasiswa->execute();

    // Hapus data dari tabel calon_mahasiswa setelah daftar ulang
    $query_delete = $conn->prepare("DELETE FROM calon_mahasiswa WHERE nomor_tes = :nomor_tes");
    $query_delete->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
    $query_delete->execute();

    // Set session dan redirect ke dashboard mahasiswa
    $_SESSION['nim'] = $nim;
    $_SESSION['status_pendaftaran'] = 'Diterima';

    header("Location: dashboard_mahasiswa.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3>Proses Daftar Ulang</h3>
        <p>Nomor Tes Anda: <strong><?php echo htmlspecialchars($nomor_tes); ?></strong></p>
        <p>Silakan klik tombol di bawah untuk menyelesaikan proses daftar ulang.</p>
        <form action="daftar_ulang.php" method="POST">
            <button type="submit" class="btn btn-success">Selesaikan Daftar Ulang</button>
        </form>
    </div>
</body>

</html>
