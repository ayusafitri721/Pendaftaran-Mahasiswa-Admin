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

    // Query untuk menghapus soal berdasarkan ID
    $delete_query = $conn->prepare("DELETE FROM soal_test WHERE id = :id");
    $delete_query->execute([':id' => $id]);

    echo "<script>alert('Soal berhasil dihapus!'); window.location.href='manage_soal.php';</script>";
    exit();
} else {
    echo "<script>alert('ID Soal tidak ditemukan!'); window.location.href='manage_soal.php';</script>";
    exit();
}
?>
