<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if ($_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Cek apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $nim = $_GET['id'];

    // Query untuk mengambil data mahasiswa berdasarkan NIM
    $query_mahasiswa = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
    $query_mahasiswa->execute([':nim' => $nim]);
    $mahasiswa = $query_mahasiswa->fetch(PDO::FETCH_ASSOC);

    // Jika mahasiswa tidak ditemukan
    if (!$mahasiswa) {
        echo "<script>alert('Mahasiswa tidak ditemukan!'); window.location.href='manage_mahasiswa.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID Mahasiswa tidak ada!'); window.location.href='manage_mahasiswa.php';</script>";
    exit();
}

// Proses pengeditan data mahasiswa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $username = $_POST['username'];

    // Query untuk mengupdate data mahasiswa
    $update_query = $conn->prepare("UPDATE mahasiswa SET nama = :nama, alamat = :alamat, nomor_handphone = :nomor_handphone, username = :username WHERE nim = :nim");
    $update_query->execute([
        ':nim' => $nim,
        ':nama' => $nama,
        ':alamat' => $alamat,
        ':nomor_handphone' => $nomor_handphone,
        ':username' => $username
    ]);

    echo "<script>alert('Data mahasiswa berhasil diupdate!'); window.location.href='manage_mahasiswa.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Mahasiswa</h3>
        <form action="edit_mahasiswa.php?id=<?php echo $mahasiswa['nim']; ?>" method="POST">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mahasiswa['nim']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?php echo $mahasiswa['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" value="<?php echo $mahasiswa['nomor_handphone']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $mahasiswa['username']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="manage_mahasiswa.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
