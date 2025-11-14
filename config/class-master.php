<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar motor
    public function getMotor(){
        $query = "SELECT * FROM tb_motor";
        $result = $this->conn->query($query);
        $motor = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $motor[] = [
                    'id' => $row['id_motor'],
                    'nama' => $row['nama_motor']
                ];
            }
        }
        return $motor;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nama_provinsi']
                ];
            }
        }
        return $provinsi;
    }

    // Method untuk mendapatkan daftar status transaksi menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Pending'],
            ['id' => 2, 'nama' => 'Selesai'],
            ['id' => 3, 'nama' => 'Dibatalkan']
        ];
    }

    // Method untuk input data motor
    public function inputMotor($data){
        $kodeMotor = $data['kode'];
        $namaMotor = $data['nama'];
        $query = "INSERT INTO tb_motor (id_motor, nama_motor) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeMotor, $namaMotor);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data motor berdasarkan kode
    public function getUpdateMotor($id){
        $query = "SELECT * FROM tb_motor WHERE id_motor = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $motor = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $motor = [
                'id' => $row['id_motor'],
                'nama' => $row['nama_motor']
            ];
        }
        $stmt->close();
        return $motor;
    }

    // Method untuk mengedit data motor
    public function updateMotor($data){
        $kodeMotor = $data['kode'];
        $namaMotor = $data['nama'];
        $query = "UPDATE tb_motor SET nama_motor = ? WHERE id_motor = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaMotor, $kodeMotor);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data motor
    public function deleteMotor($id){
        $query = "DELETE FROM tb_motor WHERE id_motor = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>