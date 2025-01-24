<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: registrasi.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hasil_test = $_POST['hasil_test'];
    $nomor_induk_mahasiswa = uniqid('NIM-'); // Generate NIM

    // Update hasil tes dan NIM di database
    $query_update = $conn->prepare("
        UPDATE mahasiswa SET hasil_test = :hasil_test, nomor_induk_mahasiswa = :nim
        WHERE nomor_test = :nomor_test
    ");
    $query_update->bindParam(':hasil_test', $hasil_test, PDO::PARAM_STR);
    $query_update->bindParam(':nim', $nomor_induk_mahasiswa, PDO::PARAM_STR);
    $query_update->bindParam(':nomor_test', $_SESSION['nomor_test'], PDO::PARAM_STR);

    if ($query_update->execute()) {
        echo "Pendaftaran berhasil! Nomor Induk Mahasiswa Anda: " . $nomor_induk_mahasiswa;
    } else {
        echo "Terjadi kesalahan saat menyimpan hasil tes.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3>Masukkan Hasil Tes</h3>
        <form action="hasil_tes.php" method="POST">
            <div class="form-group">
                <label for="hasil_test">Hasil Tes:</label>
                <input type="text" class="form-control" name="hasil_test" placeholder="Masukkan hasil tes" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Hasil</button>
        </form>
    </div>
</body>
</html>