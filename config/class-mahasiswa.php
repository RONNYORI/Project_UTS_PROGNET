<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Siswa extends Database {

      public function isNisnExists($nisn, $excludeId = null){
        if($excludeId){
            // Untuk edit - cek NISN kecuali milik siswa yang sedang diedit
            $query = "SELECT id_siswa FROM tb_siswa_siswi WHERE nisn = ? AND id_siswa != ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $nisn, $excludeId);
        } else {
            // Untuk insert - cek NISN
            $query = "SELECT id_siswa FROM tb_siswa_siswi WHERE nisn = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $nisn);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = ($result->num_rows > 0);
        $stmt->close();
        
        return $exists;
    }

    // Method untuk input data mahasiswa
    public function inputSiswa($data){
        // Mengambil data dari parameter $data
        $nisn      = $data['nisn'];
        $nama     = $data['nama'];
        $jurusan    = $data['jurusan'];
        $alamat   = $data['alamat'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_siswa_siswi (nisn, nama_siswa, jurusan, alamat, email, telp_wali, status_pelajar) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssi",$nisn, $nama, $jurusan, $alamat, $email, $telp, $status);
            try {
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            // Cek apakah error karena duplicate entry
            if($e->getCode() == 1062){
                return 'nisn_duplicate';
            }
            return false;
    }
}

    // Method untuk mengambil semua data mahasiswa
    public function getAllSiswa(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT s.id_siswa, s.nisn, s.nama_siswa, j.nama_jurusan as jurusan, s.alamat, s.email, s.telp_wali, s.status_pelajar 
                  FROM tb_siswa_siswi s
                  JOIN tb_jurusan j ON s.jurusan = j.kode_jurusan
                  ORDER BY s.id_siswa DESC";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $siswa = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $siswa[] = [
                    'id' => $row['id_siswa'],
                    'nisn_siswa' => $row['nisn'],
                    'nama' => $row['nama_siswa'],
                    'jurusan' => $row['jurusan'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp_wali'],
                    'status_pelajar' => $row['status_pelajar']
                ];
            }
        }
        // Mengembalikan array data siswa
        return $siswa;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateSiswa($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_siswa_siswi WHERE id_siswa = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_siswa'],
                'nisn' => $row['nisn'],
                'nama' => $row['nama_siswa'],
                'jurusan' => $row['jurusan'],
                'alamat' => $row['alamat'],
                'email' => $row['email'],
                'telp' => $row['telp_wali'],
                'status' => $row['status_pelajar']
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editSiswa($data){
        // Mengambil data dari parameter $data
        $id = $data['id_siswa'];
        $nisn      = $data['nisn'];
        $nama     = $data['nama'];
        $jurusan    = $data['jurusan'];
        $alamat   = $data['alamat'];
        $email    = $data['email'];
        $telp     = $data['telp_wali'];
        $status   = $data['status_pelajar'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_siswa_siswi SET nisn = ?, nama_siswa = ?, jurusan = ?, alamat = ?, email = ?, telp_wali = ?, status_pelajar = ? WHERE id_siswa = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssii", $nisn, $nama, $jurusan, $alamat, $email, $telp, $status, $id);

        try {
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            // Cek apakah error karena duplicate entry
            if($e->getCode() == 1062){
                return 'nisn_duplicate';
            }
            return false;
    }
}
    // Method untuk menghapus data mahasiswa
    public function deleteSiswa($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_siswa_siswi WHERE id_siswa = ?";
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

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchSiswa($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT s.id_siswa, s.nisn, s.nama_siswa, j.nama_jurusan as jurusan, s.alamat, s.email, s.telp_wali, s.status_pelajar 
                  FROM tb_siswa_siswi s
                  JOIN tb_jurusan j ON s.jurusan = j.kode_jurusan
                  WHERE s.nisn LIKE ? OR s.nama_siswa LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $siswa = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $siswa[] = [
                    'id' => $row['id_siswa'],
                    'nisn_siswa' => $row['nisn'],
                    'nama' => $row['nama_siswa'],
                    'jurusan' => $row['jurusan'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp_wali'],
                    'status' => $row['status_pelajar']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $siswa;
    }

}

?>