<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['level'];

// Menu navigasi berdasarkan role
$menu = '';

if ($role === 'admin') {
    $menu = '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarAdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarAdminDropdown">
                <li><a class="dropdown-item" href="manage_mahasiswa.php">Kelola Mahasiswa</a></li>
                <li><a class="dropdown-item" href="list_pendaftar.php">Lihat Pendaftaran User</a></li>
                <li><a class="dropdown-item" href="add_soal.php">Tambah Soal Test</a></li>
                <li><a class="dropdown-item" href="manage_soal.php">Kelola Soal Test</a></li>
                <li><a class="dropdown-item" href="list_daftar_ulang.php">Daftar Ulang</a></li>
                <li><a class="dropdown-item" href="list_lulus_tidak.php">Lulus / Tidak Lulus</a></li>

            </ul>
        </li>
    ';
} elseif ($role === 'mahasiswa') {
    $menu = '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarUserDropdown">
                <li><a class="dropdown-item" href="user/daftar.php">Form Pendaftaran</a></li>
                <li><a class="dropdown-item" href="user/profile.php">Profile</a></li>
            </ul>
        </li>
    ';
} else {
    $menu = '<li class="nav-item"><span class="nav-link text-danger">Akses Ditolak</span></li>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background-color: #e0f7fa; /* Biru muda lembut untuk latar belakang */
    font-family: 'Arial', sans-serif;
}

.navbar {
    background: linear-gradient(45deg, #80deea, #00acc1); /* Biru muda ke biru tua */
    padding: 15px 0;
}

.navbar .nav-link {
    color: white;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar .nav-link:hover {
    color: #0288d1; /* Biru sedikit lebih gelap saat hover */
}

.navbar .navbar-brand {
    font-size: 1.8em;
    font-weight: bold;
    color: white;
}

.content-box {
    background: linear-gradient(135deg, #b2ebf2, #e0f7fa); /* Gradasi biru muda */
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 8px 20px rgba(0, 150, 136, 0.2); /* Bayangan lembut dengan warna biru kehijauan */
}

h1 {
    color: #00796b; /* Biru kehijauan gelap untuk kontras */
    font-weight: bold;
}

p {
    color: #004d40; /* Biru kehijauan lebih gelap untuk teks biasa */
}

.logout-btn {
    background: linear-gradient(45deg, #4dd0e1, #00838f); /* Tombol gradasi biru cerah */
    color: white;
    border-radius: 5px;
    padding: 5px 15px;
    transition: background 0.3s ease, transform 0.2s ease;
}

.logout-btn:hover {
    background: linear-gradient(45deg, #00838f, #4dd0e1); /* Gradasi terbalik saat hover */
    transform: translateY(-2px); /* Efek angkat sedikit */
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pendaftaran Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php echo $menu; ?>
                    <li class="nav-item">
                        <a href="../process/logout.php" class="nav-link logout-btn">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="content-box">
            <h1 class="text-center">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p class="text-center">Selamat datang di sistem pendaftaran mahasiswa.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
