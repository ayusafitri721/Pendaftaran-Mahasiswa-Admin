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
    $nim = $_GET['id'];

    // Query untuk menghapus mahasiswa berdasarkan NIM
    $delete_query = $conn->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
    $delete_query->execute([':nim' => $nim]);

    // Setelah berhasil dihapus, redirect kembali ke halaman manage mahasiswa
    echo "<script>alert('Data mahasiswa berhasil dihapus!'); window.location.href='manage_mahasiswa.php';</script>";
    exit();
} else {
    echo "<script>alert('ID Mahasiswa tidak ditemukan!'); window.location.href='manage_mahasiswa.php';</script>";
    exit();
}
