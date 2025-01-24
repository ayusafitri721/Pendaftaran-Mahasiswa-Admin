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
    $id = $_GET['id'];

    // Query untuk mengambil data soal berdasarkan ID
    $query_soal = $conn->prepare("SELECT * FROM soal_test WHERE id = :id");
    $query_soal->execute([':id' => $id]);
    $soal = $query_soal->fetch(PDO::FETCH_ASSOC);

    // Jika soal tidak ditemukan
    if (!$soal) {
        echo "<script>alert('Soal tidak ditemukan!'); window.location.href='manage_soal.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID Soal tidak ditemukan!'); window.location.href='manage_soal.php';</script>";
    exit();
}

// Proses untuk mengedit soal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $soal_text = $_POST['soal'];
    $pilihan_a = $_POST['pilihan_a'];
    $pilihan_b = $_POST['pilihan_b'];
    $pilihan_c = $_POST['pilihan_c'];
    $pilihan_d = $_POST['pilihan_d'];
    $jawaban = $_POST['jawaban'];

    // Query untuk update soal
    $update_query = $conn->prepare("UPDATE soal_test SET soal = :soal, pilihan_a = :pilihan_a, pilihan_b = :pilihan_b, pilihan_c = :pilihan_c, pilihan_d = :pilihan_d, jawaban = :jawaban WHERE id = :id");
    $update_query->execute([
        ':id' => $id,
        ':soal' => $soal_text,
        ':pilihan_a' => $pilihan_a,
        ':pilihan_b' => $pilihan_b,
        ':pilihan_c' => $pilihan_c,
        ':pilihan_d' => $pilihan_d,
        ':jawaban' => $jawaban
    ]);

    echo "<script>alert('Soal berhasil diupdate!'); window.location.href='manage_soal.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Soal Test</h3>
        <form action="edit_soal.php?id=<?php echo $soal['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="soal" class="form-label">Soal</label>
                <textarea class="form-control" id="soal" name="soal" required><?php echo $soal['soal']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="pilihan_a" class="form-label">Pilihan A</label>
                <input type="text" class="form-control" id="pilihan_a" name="pilihan_a" value="<?php echo $soal['pilihan_a']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_b" class="form-label">Pilihan B</label>
                <input type="text" class="form-control" id="pilihan_b" name="pilihan_b" value="<?php echo $soal['pilihan_b']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_c" class="form-label">Pilihan C</label>
                <input type="text" class="form-control" id="pilihan_c" name="pilihan_c" value="<?php echo $soal['pilihan_c']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pilihan_d" class="form-label">Pilihan D</label>
                <input type="text" class="form-control" id="pilihan_d" name="pilihan_d" value="<?php echo $soal['pilihan_d']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jawaban" class="form-label">Jawaban</label>
                <select class="form-control" id="jawaban" name="jawaban" required>
                    <option value="A" <?php echo ($soal['jawaban'] == 'A' ? 'selected' : ''); ?>>A</option>
                    <option value="B" <?php echo ($soal['jawaban'] == 'B' ? 'selected' : ''); ?>>B</option>
                    <option value="C" <?php echo ($soal['jawaban'] == 'C' ? 'selected' : ''); ?>>C</option>
                    <option value="D" <?php echo ($soal['jawaban'] == 'D' ? 'selected' : ''); ?>>D</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Soal</button>
            <a href="manage_soal.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
