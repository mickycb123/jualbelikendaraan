<?php

// Memasukkan file class-transaksi.php untuk mengakses class Transaksi
include_once '../config/class-transaksi.php';
// Membuat objek dari class Transaksi
$transaksi = new Transaksi();
// Mengambil data transaksi dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataTransaksi = [
    'id' => $_POST['id'],
    'customer' => $_POST['customer'],
    'motor' => $_POST['motor'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method editTransaksi untuk mengupdate data transaksi dengan parameter array $dataTransaksi
$edit = $transaksi->editTransaksi($dataTransaksi);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id transaksi
    header("Location: ../data-edit.php?id=".$dataTransaksi['id']."&status=failed");
}

?>