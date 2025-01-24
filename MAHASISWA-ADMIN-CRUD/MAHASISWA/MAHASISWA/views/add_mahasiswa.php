<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if ($_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $username = $_POST['username'];

    // Query untuk memasukkan data mahasiswa baru
    $query = $conn->prepare("INSERT INTO mahasiswa (nim, nama, alamat, nomor_handphone, username) VALUES (:nim, :nama, :alamat, :nomor_handphone, :username)");
    $query->bindParam(':nim', $nim);
    $query->bindParam(':nama', $nama);
    $query->bindParam(':alamat', $alamat);
    $query->bindParam(':nomor_handphone', $nomor_handphone);
    $query->bindParam(':username', $username);
    
    if ($query->execute()) {
        echo "<script>alert('Mahasiswa berhasil ditambahkan!'); window.location.href='manage_mahasiswa.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan mahasiswa.'); window.location.href='manage_mahasiswa.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Tambah Mahasiswa Baru</h3>
        <form action="add_mahasiswa.php" method="POST">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
        </form>
    </div>
</body>
</html>
