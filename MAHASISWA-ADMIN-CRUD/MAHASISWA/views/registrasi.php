<?php
session_start();
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password untuk keamanan

    // Validasi apakah nomor telepon sudah ada
    $query_check = $conn->prepare("SELECT * FROM mahasiswa WHERE nomor_handphone = :nomor_handphone");
    $query_check->bindParam(':nomor_handphone', $nomor_handphone, PDO::PARAM_STR);
    $query_check->execute();

    if ($query_check->rowCount() > 0) {
        $error_message = "Nomor handphone sudah digunakan! Silakan gunakan nomor lain.";
    } else {
        // Tambahkan data calon mahasiswa baru
        $query_insert = $conn->prepare("
            INSERT INTO calon_mahasiswa (nama, alamat, nomor_handphone, username, password, status_pendaftaran)
            VALUES (:nama, :alamat, :nomor_handphone, :username, :password, 'Belum Tes')
        ");
        $query_insert->bindParam(':nama', $nama, PDO::PARAM_STR);
        $query_insert->bindParam(':alamat', $alamat, PDO::PARAM_STR);
        $query_insert->bindParam(':nomor_handphone', $nomor_handphone, PDO::PARAM_STR);
        $query_insert->bindParam(':username', $username, PDO::PARAM_STR);
        $query_insert->bindParam(':password', $password, PDO::PARAM_STR);

        if ($query_insert->execute()) {
            // Ambil ID terakhir untuk dijadikan nomor tes
            $calon_id = $conn->lastInsertId();
            $nomor_tes = "TES" . str_pad($calon_id, 5, "0", STR_PAD_LEFT);

            // Update calon mahasiswa dengan nomor tes
            $query_update = $conn->prepare("
                UPDATE calon_mahasiswa SET nomor_tes = :nomor_tes WHERE id = :calon_id
            ");
            $query_update->bindParam(':nomor_tes', $nomor_tes, PDO::PARAM_STR);
            $query_update->bindParam(':calon_id', $calon_id, PDO::PARAM_INT);
            $query_update->execute();

            // Set session dan redirect ke halaman tes
            $_SESSION['username'] = $username;
            $_SESSION['nomor_tes'] = $nomor_tes;
            $_SESSION['status_pendaftaran'] = 'Belum Tes';

            header("Location: tes.php");
            exit();
        } else {
            $error_message = "Terjadi kesalahan saat registrasi. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Calon Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
    background-color: #f0f8ff; /* Warna background yang lebih terang */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Arial', sans-serif;
}

.register-container {
    max-width: 450px;
    padding: 30px;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 181, 226, 0.2); /* Shade biru terang */
}

.register-container h3 {
    font-weight: bold;
    margin-bottom: 10px;
    color: #00b5e2; /* Lighter blue for the title */
    text-align: center;
}

.register-container .form-control {
    border-radius: 10px;
    padding: 10px;
    border: 2px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 181, 226, 0.2);
}

.register-container .form-control:focus {
    border-color: #00b5e2; /* Fokus border dengan warna biru */
    box-shadow: 0 0 10px rgba(0, 181, 226, 0.5); /* Fokus glow effect */
}

.btn-primary {
    background: linear-gradient(45deg, #00b5e2, #0073e6); /* Biru terang ke biru lebih gelap */
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    width: 100%;
    color: white;
    font-weight: bold;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0073e6, #00b5e2); /* Hover effect pada tombol */
    transform: translateY(-2px); /* Menambahkan efek angkat sedikit */
}

p {
    text-align: center;
    margin-top: 20px;
}

p a {
    color: #00b5e2;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="register-container">
        <h3>Registrasi Calon Mahasiswa</h3>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="registrasi.php" method="POST">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="nomor_handphone" placeholder="Nomor Handphone" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">Sudah punya akun? <a href="loginregis.php">Log In</a></p>
    </div>
</body>
</html>
