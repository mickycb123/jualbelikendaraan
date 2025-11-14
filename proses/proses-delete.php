<?php

// Memasukkan file class-transaksi.php untuk mengakses class Transaksi
include_once '../config/class-transaksi.php';
// Membuat objek dari class Transaksi
$transaksi = new Transaksi();
// Mengambil id transaksi dari parameter GET
$id = $_GET['id'];
// Memanggil method deleteTransaksi untuk menghapus data transaksi berdasarkan id
$delete = $transaksi->deleteTransaksi($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>