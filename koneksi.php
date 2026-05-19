<?php

$koneksi = mysqli_connect('localhost','root','','db_alumni_telkom');
if (!$koneksi) {
    // menutup dan menampilkan erorr
    die("koneksi gagal: ") . mysqli_connect_error();
}
?>