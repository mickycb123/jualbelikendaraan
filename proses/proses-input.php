<?php

// Memasukkan file class-transaksi.php untuk mengakses class Transaksi
include '../config/class-transaksi.php';
// Membuat objek dari class Transaksi
$transaksi = new Transaksi();
// Mengambil data transaksi dari form input menggunakan metode POST dan menyimpannya dalam array
$dataTransaksi = [
    'customer' => $_POST['customer'],
    'motor' => $_POST['motor'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    // 'status' => $_POST['status']
];
// Memanggil method inputTransaksi untuk memasukkan data transaksi dengan parameter array $dataTransaksi
$input = $transaksi->inputTransaksi($dataTransaksi);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>