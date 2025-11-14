<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Transaksi extends Database {

    // Method untuk input data transaksi
    public function inputTransaksi($data){
        // Mengambil data dari parameter $data
        $customer = $data['customer'];
        $motor    = $data['motor'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        // $status   = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_transaksi (nama_customer, id_motor, alamat, provinsi, email, telp) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssss", $customer, $motor, $alamat, $provinsi, $email, $telp);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data transaksi
    public function getAllTransaksi(){
        // Menyiapkan query SQL untuk mengambil data transaksi beserta motor dan provinsi
        $query = "SELECT t.id_transaksi, t.nama_customer, m.nama_motor, p.nama_provinsi, t.alamat, t.email, t.telp, t.status_transaksi 
                  FROM tb_transaksi t
                  JOIN tb_motor m ON t.id_motor = m.id_motor
                  JOIN tb_provinsi p ON t.provinsi = p.id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data transaksi
        $transaksi = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $transaksi[] = [
                    'id' => $row['id_transaksi'],
                    'customer' => $row['nama_customer'],
                    'motor' => $row['nama_motor'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_transaksi']
                ];
            }
        }
        // Mengembalikan array data transaksi
        return $transaksi;
    }

    // Method untuk mengambil data transaksi berdasarkan ID
    public function getUpdateTransaksi($id){
        // Menyiapkan query SQL untuk mengambil data transaksi berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_transaksi WHERE id_transaksi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data transaksi  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_transaksi'],
                'customer' => $row['nama_customer'],
                'motor' => $row['id_motor'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['provinsi'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_transaksi']
            ];
        }
        $stmt->close();
        // Mengembalikan data transaksi
        return $data;
    }

    // Method untuk mengedit data transaksi
    public function editTransaksi($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $customer = $data['customer'];
        $motor    = $data['motor'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_transaksi SET nama_customer = ?, id_motor = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_transaksi = ? WHERE id_transaksi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssii", $customer, $motor, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data transaksi
    public function deleteTransaksi($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_transaksi WHERE id_transaksi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data transaksi berdasarkan kata kunci
    public function searchTransaksi($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data transaksi menggunakan prepared statement
        $query = "SELECT t.id_transaksi, t.nama_customer, m.nama_motor, p.nama_provinsi, t.alamat, t.email, t.telp, t.status_transaksi 
                  FROM tb_transaksi t
                  JOIN tb_motor m ON t.id_motor = m.id_motor
                  JOIN tb_provinsi p ON t.provinsi = p.id_provinsi
                  WHERE t.nama_customer LIKE ? OR m.nama_motor LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data transaksi
        $transaksi = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data transaksi dalam array
                $transaksi[] = [
                    'id' => $row['id_transaksi'],
                    'customer' => $row['nama_customer'],
                    'motor' => $row['nama_motor'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_transaksi']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data transaksi yang ditemukan
        return $transaksi;
    }

}

?>