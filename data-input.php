<?php 
// Memuat class master untuk mendapatkan data dropdown
// ASUMSI: file 'config/class-master.php' tersedia di lingkungan Anda.
include_once 'config/class-master.php';
$master = new MasterData();
// Mengambil daftar motor, provinsi, dan status
$motorList = $master->getMotor();
$provinsiList = $master->getProvinsi();
$statusList = $master->getStatus();

// Logika untuk menampilkan pesan kegagalan (Mengganti alert() dengan variabel untuk pesan)
$errorMessage = null;
if(isset($_GET['status']) && $_GET['status'] == 'failed'){
    // Menggunakan variabel untuk ditampilkan sebagai alert Bootstrap di dalam body
    $errorMessage = 'Gagal menambahkan data transaksi. Silakan coba lagi.';
}
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include 'template/header.php'; ?>
        <style>
            /* 1. Reset/Base Styling */
            body {
                /* Font Inter adalah pilihan modern dan bersih */
                font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
                background-color: #f8f9fa; /* Latar belakang abu-abu sangat terang */
                color: #212529;
            }

            /* 2. Container Styling */
            .app-content {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem;
            }

            /* 3. Card Styling (Fokus Minimalis & Bersih) */
            .card {
                border: 1px solid #dee2e6; /* Border tipis untuk definisi */
                border-radius: 1rem; /* Sudut membulat */
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Bayangan lembut */
                transition: box-shadow 0.3s ease;
                margin-bottom: 1.5rem;
            }

            .card-header {
                background-color: #ffffff;
                border-bottom: 1px solid #e9ecef;
                border-radius: 1rem 1rem 0 0;
                padding: 1.5rem;
            }

            .card-title {
                font-weight: 700;
                color: #212529;
                /* Garis aksen biru yang profesional */
                border-left: 6px solid #007bff; 
                padding-left: 15px;
                line-height: 1.2;
                font-size: 1.5rem;
            }

            /* 4. Form and Input Styling */
            .form-label {
                font-weight: 600;
                color: #495057; /* Sedikit lebih abu-abu dari teks biasa */
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }
            
            .form-control,
            .form-select {
                border-radius: 0.5rem;
                border: 1px solid #ced4da; /* Border standar */
                padding: 0.8rem 1rem;
                background-color: #ffffff;
                transition: all 0.2s ease-in-out;
            }

            /* Efek Fokus Bersih */
            .form-control:focus,
            .form-select:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Focus ring biru yang lembut */
                background-color: #ffffff;
            }
            
            /* Placeholder lebih halus */
            .form-control::placeholder {
                color: #adb5bd;
                opacity: 1; 
            }

            /* 5. Button Styling in Footer */
            .card-footer {
                /* Mengganti warna merah footer yang aneh dengan latar belakang putih bersih */
                background-color: #ffffff; 
                border-top: 1px solid #e9ecef;
                border-radius: 0 0 1rem 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem;
            }
            
            /* Tombol Primer (Submit) */
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                font-weight: 600;
                border-radius: 0.5rem;
                padding: 0.75rem 1.75rem;
                letter-spacing: 0.5px;
                transition: background-color 0.2s, border-color 0.2s, transform 0.1s;
            }
            .btn-primary:hover {
                background-color: #0069d9;
                border-color: #0062cc;
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            }

            /* Tombol Sekunder (Batal & Reset) */
            .btn-danger {
                background-color: #dc3545; /* Tetap merah untuk Batal/Danger */
                border-color: #dc3545;
            }
            .btn-danger:hover {
                background-color: #c82333;
                border-color: #bd2130;
            }
            .btn-secondary {
                background-color: #6c757d; /* Abu-abu untuk Reset */
                border-color: #6c757d;
            }
            .btn-secondary:hover {
                background-color: #5a6268;
                border-color: #545b62;
            }
            .btn-danger, .btn-secondary {
                border-radius: 0.5rem;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
            }
        </style>
    </head>

    <body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

        <div class="app-wrapper">

            <?php include 'template/navbar.php'; ?>

            <?php include 'template/sidebar.php'; ?>

            <main class="app-main">

                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Input Transaksi Kendaraan</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Input Data</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <!-- MEMBATASI LEBAR FORMULIR AGAR TERPUSAT DAN TIDAK TERLALU LEBAR -->
                            <div class="col-12 col-md-10 col-lg-7"> 
                                
                                <!-- Alert Box Pengganti PHP alert() -->
                                <?php if ($errorMessage): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Gagal!</strong> <?php echo $errorMessage; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Formulir Transaksi</h3>
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
                                    <form action="proses/proses-input.php" method="POST">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Nama Customer</label>
                                                <input type="text" class="form-control" id="customer" name="customer" placeholder="Masukkan Nama Lengkap Customer" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="motor" class="form-label">Jenis Motor</label>
                                                <select class="form-select" id="motor" name="motor" required>
                                                    <option value="" selected disabled>Pilih Jenis Motor</option>
                                                    <?php 
                                                    foreach ($motorList as $motor){
                                                        echo '<option value="'.$motor['id'].'">'.$motor['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    foreach ($provinsiList as $provinsi){
                                                        echo '<option value="'.$provinsi['id'].'">'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telpon/HP" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <!-- Pastikan tombol Batal mengarah ke halaman yang benar -->
                                                <button type="button" class="btn btn-danger me-2" onclick="window.location.href='data-list.php'">Batal</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <?php include 'template/footer.php'; ?>

        </div>
        
        <?php include 'template/script.php'; ?>

    </body>
</html>