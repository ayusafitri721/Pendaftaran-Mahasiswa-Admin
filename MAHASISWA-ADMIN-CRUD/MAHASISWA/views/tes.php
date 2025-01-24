<?php
session_start();
include '../db/config.php';

// Cek apakah user sudah login dan memiliki nomor tes
if (!isset($_SESSION['username']) || !isset($_SESSION['nomor_tes'])) {
    header("Location: login.php");
    exit();
}

$nomor_tes = $_SESSION['nomor_tes'];

// Ambil soal dari database
$query_soal = $conn->prepare("SELECT * FROM soal_test");
$query_soal->execute();
$soal_list = $query_soal->fetchAll(PDO::FETCH_ASSOC);

// Jika form tes disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai_tes = 0;

    // Menghitung skor berdasarkan jawaban yang diberikan mahasiswa
    foreach ($soal_list as $soal) {
        if (isset($_POST['jawaban_' . $soal['id']]) && $_POST['jawaban_' . $soal['id']] === $soal['jawaban']) {
            $nilai_tes++;
        }
    }

    try {
        // Hitung nilai maksimum dan ubah skor menjadi persentase
        $total_soal = count($soal_list);
        $nilai_tes = ($nilai_tes / $total_soal) * 100;

        // Simpan hasil tes ke tabel `hasil_tes`
        $query_insert = $conn->prepare("
            INSERT INTO hasil_tes (nomor_tes, nilai_tes, status_lulus)
            VALUES (:nomor_tes, :nilai_tes, :status_lulus)
        ");
        $status_lulus = $nilai_tes >= 70 ? 'Lulus' : 'Tidak Lulus';
        $query_insert->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
        $query_insert->bindParam(':nilai_tes', $nilai_tes, PDO::PARAM_INT);
        $query_insert->bindParam(':status_lulus', $status_lulus, PDO::PARAM_STR);
        $query_insert->execute();

        // Update status di tabel `calon_mahasiswa`
        $query_update = $conn->prepare("
            UPDATE calon_mahasiswa 
            SET status_pendaftaran = :status_pendaftaran 
            WHERE nomor_tes = :nomor_tes
        ");
        $status_pendaftaran = $status_lulus === 'Lulus' ? 'Lulus Tes' : 'Tidak Lulus';
        $query_update->bindParam(':status_pendaftaran', $status_pendaftaran, PDO::PARAM_STR);
        $query_update->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
        $query_update->execute();

        // Update status pendaftaran di session
        $_SESSION['status_pendaftaran'] = $status_pendaftaran;

        // Redirect ke halaman berikutnya
        if ($status_lulus === 'Lulus') {
            header("Location: daftar_ulang.php");
        } else {
            echo "<script>alert('Maaf, Anda tidak lulus tes.'); window.location.href = 'tes.php';</script>";
        }
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Selamat Datang di Halaman Tes</h3>
        <p>Nomor Tes Anda: <strong><?php echo htmlspecialchars($nomor_tes); ?></strong></p>
        <form action="tes.php" method="POST">
            <?php
            // Tampilkan soal satu per satu
            foreach ($soal_list as $soal) {
                echo "<div class='mb-3'>";
                echo "<p><strong>{$soal['soal']}</strong></p>";
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='jawaban_{$soal['id']}' value='A' id='jawaban_A_{$soal['id']}'>";
                echo "<label class='form-check-label' for='jawaban_A_{$soal['id']}'>{$soal['pilihan_a']}</label>";
                echo "</div>";
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='jawaban_{$soal['id']}' value='B' id='jawaban_B_{$soal['id']}'>";
                echo "<label class='form-check-label' for='jawaban_B_{$soal['id']}'>{$soal['pilihan_b']}</label>";
                echo "</div>";
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='jawaban_{$soal['id']}' value='C' id='jawaban_C_{$soal['id']}'>";
                echo "<label class='form-check-label' for='jawaban_C_{$soal['id']}'>{$soal['pilihan_c']}</label>";
                echo "</div>";
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='jawaban_{$soal['id']}' value='D' id='jawaban_D_{$soal['id']}'>";
                echo "<label class='form-check-label' for='jawaban_D_{$soal['id']}'>{$soal['pilihan_d']}</label>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit Tes</button>
        </form>
    </div>
</body>
</html>
