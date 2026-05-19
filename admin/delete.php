<?php
session_start();
include __DIR__ . '/../koneksi.php';

// Pastikan ada parameter id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data
    mysqli_query($koneksi, "DELETE FROM alumni WHERE id_alumni= $id");

    // Menyusun ulang ID agar urut lagi dari 1
    mysqli_query($koneksi, "SET @num := 0");
    mysqli_query($koneksi, "UPDATE alumni SET id_alumni = @num := @num + 1 ORDER BY id_alumni");

    // Reset auto increment agar lanjut dari ID terakhir
    mysqli_query($koneksi, "ALTER TABLE alumni AUTO_INCREMENT = 1");
}

// Kembali ke halaman utama
header("location: ./dashboard.php");
exit;