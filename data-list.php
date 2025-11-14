<?php

include_once 'config/class-transaksi.php';
$transaksi = new Transaksi();

// Fungsi kustom untuk menampilkan notifikasi (menggantikan alert())
function showCustomToast($message, $type) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastContainer = document.getElementById('custom-toast-container');
            if (toastContainer) {
                const toast = document.createElement('div');
                toast.className = 'custom-toast custom-toast-' + '{$type}';
                toast.innerHTML = '{$message}';
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('show');
                }, 10); 
                setTimeout(() => {
                    toast.classList.remove('show');
                    toast.addEventListener('transitionend', () => toast.remove());
                }, 5000);
            }
        });
    </script>";
}

// Menampilkan notifikasi berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
    if($_GET['status'] == 'inputsuccess'){
        showCustomToast('Data transaksi berhasil ditambahkan.', 'success');
    } else if($_GET['status'] == 'editsuccess'){
        showCustomToast('Data transaksi berhasil diubah.', 'success');
    } else if($_GET['status'] == 'deletesuccess'){
        showCustomToast('Data transaksi berhasil dihapus.', 'success');
    } else if($_GET['status'] == 'deletefailed'){
        showCustomToast('Gagal menghapus data transaksi. Silakan coba lagi.', 'danger');
    }
}
$dataTransaksi = $transaksi->getAllTransaksi();

?>
<!doctype html>
<html lang="en">
    <head>
        <?php include 'template/header.php'; ?>
        <!-- Custom CSS untuk mempersempit tabel dan notifikasi -->
        <style>
            /* Custom Toast Notification Styles */
            #custom-toast-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1050;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .custom-toast {
                padding: 10px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                color: #fff;
                opacity: 0;
                transform: translateY(-20px);
                transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            }
            .custom-toast.show {
                opacity: 1;
                transform: translateY(0);
            }
            .custom-toast-success {
                background-color: #28a745;
            }
            .custom-toast-danger {
                background-color: #dc3545;
            }

            /* Custom Confirmation Modal Styles */
            .custom-modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 1040;
            }
            .custom-modal {
                background: white;
                padding: 30px;
                border-radius: 12px;
                width: 90%;
                max-width: 400px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                text-align: center;
            }
            .custom-modal h5 {
                margin-top: 0;
                margin-bottom: 20px;
                font-weight: 600;
            }
            .custom-modal-actions button {
                margin: 0 10px;
            }
        </style>
    </head>

    <body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
        
        <!-- Custom Toast Container -->
        <div id="custom-toast-container"></div>

        <!-- Custom Confirmation Modal -->
        <div id="custom-confirm-modal-overlay" class="custom-modal-overlay">
            <div class="custom-modal">
                <h5 id="custom-confirm-message"></h5>
                <div class="custom-modal-actions">
                    <button id="custom-confirm-cancel" class="btn btn-secondary">Batal</button>
                    <button id="custom-confirm-ok" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>

        <div class="app-wrapper">

            <?php include 'template/navbar.php'; ?>

            <?php include 'template/sidebar.php'; ?>

            <main class="app-main">

                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Daftar Transaksi</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Transaksi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- MODIFIKASI: Menambahkan col-xl-10 dan mx-auto untuk membatasi lebar dan memposisikan di tengah -->
                            <div class="col-12 col-xl-10 mx-auto"> 
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Transaksi</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-responsive">
                                        <table class="table table-striped" role="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Customer</th>
                                                    <th>Motor</th>
                                                    <th>Provinsi</th>
                                                    <th>Alamat</th>
                                                    <th>Telp</th>
                                                    <th>Email</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(count($dataTransaksi) == 0){
                                                        echo '<tr class="align-middle">
                                                                <td colspan="10" class="text-center">Tidak ada data transaksi.</td>
                                                            </tr>';
                                                    } else {
                                                        foreach ($dataTransaksi as $index => $trx){
                                                            $statusText = '';
                                                            if($trx['status'] == 1){
                                                                $statusText = '<span class="badge bg-warning text-dark">Pending</span>';
                                                            } elseif($trx['status'] == 2){
                                                                $statusText = '<span class="badge bg-success">Selesai</span>';
                                                            } elseif($trx['status'] == 3){
                                                                $statusText = '<span class="badge bg-danger">Dibatalkan</span>';
                                                            } 
                                                            
                                                            // MODIFIKASI: Mengganti confirm() dengan fungsi kustom showCustomConfirm()
                                                            $deleteAction = "showCustomConfirm('Yakin ingin menghapus data transaksi ini?', 'proses/proses-delete.php?id=".$trx['id']."')";
                                                            
                                                            echo '<tr class="align-middle">
                                                                <td>'.($index + 1).'</td>
                                                                <td>'.$trx['customer'].'</td>
                                                                <td>'.$trx['motor'].'</td>
                                                                <td>'.$trx['provinsi'].'</td>
                                                                <td>'.$trx['alamat'].'</td>
                                                                <td>'.$trx['telp'].'</td>
                                                                <td>'.$trx['email'].'</td>
                                                                <td class="text-center">'.$statusText.'</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$trx['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                                    <button type="button" class="btn btn-sm btn-danger" onclick="'.$deleteAction.'"><i class="bi bi-trash-fill"></i> Hapus</button>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Transaksi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <?php include 'template/footer.php'; ?>

        </div>
        
        <?php include 'template/script.php'; ?>

        <!-- Custom JS for Confirmation Modal (to replace confirm()) -->
        <script>
            function showCustomConfirm(message, actionUrl) {
                const overlay = document.getElementById('custom-confirm-modal-overlay');
                const msgElement = document.getElementById('custom-confirm-message');
                const okButton = document.getElementById('custom-confirm-ok');
                const cancelButton = document.getElementById('custom-confirm-cancel');

                msgElement.textContent = message;
                overlay.style.display = 'flex';

                const handleConfirm = () => {
                    window.location.href = actionUrl;
                    overlay.style.display = 'none';
                    removeListeners();
                };

                const handleCancel = () => {
                    overlay.style.display = 'none';
                    removeListeners();
                };

                const removeListeners = () => {
                    okButton.removeEventListener('click', handleConfirm);
                    cancelButton.removeEventListener('click', handleCancel);
                    overlay.removeEventListener('click', handleOverlayClick);
                };

                const handleOverlayClick = (e) => {
                    if (e.target === overlay) {
                        handleCancel();
                    }
                };
                
                okButton.addEventListener('click', handleConfirm);
                cancelButton.addEventListener('click', handleCancel);
                overlay.addEventListener('click', handleOverlayClick);
            }
        </script>

    </body>
</html>