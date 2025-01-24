<?php
session_start();
include '../db/config.php';

// Cek apakah admin sudah login
if ($_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Proses untuk menambah soal baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $soal = $_POST['soal'];
    $pilihan_a = $_POST['pilihan_a'];
    $pilihan_b = $_POST['pilihan_b'];
    $pilihan_c = $_POST['pilihan_c'];
    $pilihan_d = $_POST['pilihan_d'];
    $jawaban = $_POST['jawaban'];

    // Query untuk memasukkan soal baru
    $insert_query = $conn->prepare("INSERT INTO soal_test (soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban) VALUES (:soal, :pilihan_a, :pilihan_b, :pilihan_c, :pilihan_d, :jawaban)");
    $insert_query->execute([
        ':soal' => $soal,
        ':pilihan_a' => $pilihan_a,
        ':pilihan_b' => $pilihan_b,
        ':pilihan_c' => $pilihan_c,
        ':pilihan_d' => $pilihan_d,
        ':jawaban' => $jawaban
    ]);

    echo "<script>alert('Soal berhasil ditambahkan!'); window.location.href='manage_soal.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Tambah Soal Test</h3>
        <form action="add_soal.php" method="POST">
            <div class="mb-3">
                <label for="soal" class="form-label">Soal</label>
                <textarea class="form-control" id="soal" name="soal" required></textarea>
            </div>
            <div class="mb-3">
                <label for="pilihan_a" class="form-label">Pilihan A</label>
                <input type="text" class="form-control" id="pilihan_a" name="pilihan_a" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_b" class="form-label">Pilihan B</label>
                <input type="text" class="form-control" id="pilihan_b" name="pilihan_b" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_c" class="form-label">Pilihan C</label>
                <input type="text" class="form-control" id="pilihan_c" name="pilihan_c" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_d" class="form-label">Pilihan D</label>
                <input type="text" class="form-control" id="pilihan_d" name="pilihan_d" required>
            </div>
            <div class="mb-3">
                <label for="jawaban" class="form-label">Jawaban</label>
                <select class="form-control" id="jawaban" name="jawaban" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Tambah Soal</button>
            <a href="manage_soal.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
