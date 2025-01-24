<?php
session_start();
include '../db/config.php'; // Ganti dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data mahasiswa berdasarkan username
    $query = $conn->prepare("SELECT * FROM calon_mahasiswa WHERE username = :username");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    // Ambil data hasil query
    $mahasiswa = $query->fetch(PDO::FETCH_ASSOC);

    // Cek apakah data ditemukan dan password valid
    if ($mahasiswa && password_verify($password, $mahasiswa['password'])) {
        // Simpan data mahasiswa ke session
        $_SESSION['mahasiswa'] = [
            'id' => $mahasiswa['id'],
            'nama' => $mahasiswa['nama'],
            'username' => $mahasiswa['username'],
            'nomor_tes' => $mahasiswa['nomor_tes'],
            'status_pendaftaran' => $mahasiswa['status_pendaftaran']
        ];

        // Redirect ke dashboard mahasiswa
        header("Location: dashboard_mahasiswa.php");
        exit();
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            max-width: 400px;
            padding: 30px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 181, 226, 0.2);
        }

        .login-container h3 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #00b5e2;
            text-align: center;
        }

        .login-container .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 181, 226, 0.2);
        }

        .login-container .form-control:focus {
            border-color: #00b5e2;
            box-shadow: 0 0 10px rgba(0, 181, 226, 0.5);
        }

        .btn-primary {
            background: linear-gradient(45deg, #00b5e2, #0073e6);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            width: 100%;
            color: white;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0073e6, #00b5e2);
            transform: translateY(-2px);
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
    <div class="login-container">
        <h3>Login Mahasiswa</h3>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="dashboard_mahasiswa.php" method="POST">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Belum punya akun? <a href="registrasi.php">Registrasi</a></p>
    </div>
</body>
</html>
