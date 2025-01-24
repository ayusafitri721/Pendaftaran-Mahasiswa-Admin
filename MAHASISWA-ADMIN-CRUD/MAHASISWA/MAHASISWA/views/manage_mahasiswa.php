<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if ($_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil data mahasiswa
$query_mahasiswa = $conn->prepare("SELECT * FROM mahasiswa");
$query_mahasiswa->execute();
$mahasiswa_list = $query_mahasiswa->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Kelola Mahasiswa</h3>
        <a href="add_mahasiswa.php" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor Handphone</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data mahasiswa
                $no = 1;
                foreach ($mahasiswa_list as $mahasiswa) {
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    echo "<td>{$mahasiswa['nim']}</td>";
                    echo "<td>{$mahasiswa['nama']}</td>";
                    echo "<td>{$mahasiswa['alamat']}</td>";
                    echo "<td>{$mahasiswa['nomor_handphone']}</td>";
                    echo "<td>{$mahasiswa['username']}</td>";
                    echo "<td>
                            <a href='edit_mahasiswa.php?id={$mahasiswa['nim']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_mahasiswa.php?id={$mahasiswa['nim']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
