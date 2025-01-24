<?php
session_start();
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data dari tabel users
    $query = $conn->prepare("SELECT * FROM users WHERE Username = :username");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        // Simpan ke session
        $_SESSION['username'] = $user['Username'];
        $_SESSION['level'] = $user['Level'];

        // Redirect berdasarkan level
        if ($user['Level'] === 'user') {
            header("Location: ../views/dashboard_mahasiswa.php");
        } else if ($user['Level'] === 'admin') {
            header("Location: ../views/dashboard_admin.php");
        }
        exit();
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>
