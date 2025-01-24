<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if ($_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil data soal test
$query_soal = $conn->prepare("SELECT * FROM soal_test");
$query_soal->execute();
$soal_list = $query_soal->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Kelola Soal Test</h3>
        <a href="add_soal.php" class="btn btn-primary mb-3">Tambah Soal Test</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Soal</th>
                    <th>Pilihan A</th>
                    <th>Pilihan B</th>
                    <th>Pilihan C</th>
                    <th>Pilihan D</th>
                    <th>Jawaban</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data soal
                $no = 1;
                foreach ($soal_list as $soal) {
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    echo "<td>{$soal['soal']}</td>";
                    echo "<td>{$soal['pilihan_a']}</td>";
                    echo "<td>{$soal['pilihan_b']}</td>";
                    echo "<td>{$soal['pilihan_c']}</td>";
                    echo "<td>{$soal['pilihan_d']}</td>";
                    echo "<td>{$soal['jawaban']}</td>";
                    echo "<td>
                            <a href='edit_soal.php?id={$soal['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_soal.php?id={$soal['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this question?\")'>Delete</a>
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
