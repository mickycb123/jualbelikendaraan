<?php 

include_once 'config/class-master.php';
include_once 'config/class-transaksi.php';
$master = new MasterData();
$transaksi = new Transaksi();
// Mengambil daftar motor, provinsi, dan status
$motorList = $master->getMotor();
// Mengambil daftar provinsi
$provinsiList = $master->getProvinsi();
// Mengambil daftar status
$statusList = $master->getStatus();
// Mengambil data transaksi yang akan diedit berdasarkan id dari parameter GET
$dataTransaksi = $transaksi->getUpdateTransaksi($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data transaksi. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
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
								<h3 class="mb-0">Edit Transaksi</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
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
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataTransaksi['id']; ?>">
                                            <div class="mb-3">
                                                <label for="customer" class="form-label">Nama Customer</label>
                                                <input type="text" class="form-control" id="customer" name="customer" placeholder="Masukkan Nama Customer" value="<?php echo $dataTransaksi['customer']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="motor" class="form-label">Jenis Motor</label>
                                                <select class="form-select" id="motor" name="motor" required>
                                                    <option value="" selected disabled>Pilih Jenis Motor</option>
                                                    <?php 
                                                    foreach ($motorList as $motor){
                                                        $selectedMotor = "";
                                                        if($dataTransaksi['motor'] == $motor['id']){
                                                            $selectedMotor = "selected";
                                                        }
                                                        echo '<option value="'.$motor['id'].'" '.$selectedMotor.'>'.$motor['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap" required><?php echo $dataTransaksi['alamat']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    foreach ($provinsiList as $provinsi){
                                                        $selectedProvinsi = "";
                                                        if($dataTransaksi['provinsi'] == $provinsi['id']){
                                                            $selectedProvinsi = "selected";
                                                        }
                                                        echo '<option value="'.$provinsi['id'].'" '.$selectedProvinsi.'>'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid" value="<?php echo $dataTransaksi['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telpon/HP" value="<?php echo $dataTransaksi['telp']; ?>" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    foreach ($statusList as $status){
                                                        $selectedStatus = "";
                                                        if($dataTransaksi['status'] == $status['id']){
                                                            $selectedStatus = "selected";
                                                        }
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
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