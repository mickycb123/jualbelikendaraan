<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputmotor'){
    // Mengambil data motor dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataMotor = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputMotor untuk memasukkan data motor dengan parameter array $dataMotor
    $input = $master->inputMotor($dataMotor);
    if($input){
        // Jika berhasil, redirect ke halaman master-motor-edit.php dengan status inputsuccess
        header("Location: ../master-motor-edit.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-motor-edit.php dengan status failed
        header("Location: ../master-motor-edit.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatemotor'){
    // Mengambil data motor dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataMotor = [
        'kode' => $_POST['kode'], // 'kode' dari 'id' yang di-readonly di form edit
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateMotor untuk mengupdate data motor dengan parameter array $dataMotor
    $update = $master->updateMotor($dataMotor);
    if($update){
        // Jika berhasil, redirect ke halaman master-motor-list.php dengan status editsuccess
        header("Location: ../master-motor-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-motor-edit.php dengan status failed dan membawa id motor
        header("Location: ../master-motor -edit.php?id=".$dataMotor['kode']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletemotor'){
    // Mengambil id motor dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteMotor untuk menghapus data motor berdasarkan id
    $delete = $master->deleteMotor($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-motor-list.php dengan status deletesuccess
        header("Location: ../master-motor-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-motor-list.php dengan status deletefailed
        header("Location: ../master-motor-list.php?status=deletefailed");
    }
}

?>