<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-mahasiswa.php';
// Membuat objek dari class Mahasiswa
$siswa = new siswa();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array

$dataSiswa = [
    'nisn' => $_POST['nisn'],
    'nama' => $_POST['nama_siswa'],
    'jurusan' => $_POST['jurusan'],
    'alamat' => $_POST['alamat'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp_wali'],
    'status' => $_POST['status_pelajar']
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $siswa->inputSiswa($dataSiswa);
// Mengecek apakah proses input berhasil atau tidak - true/false

if($input === true){
    // Berhasil
    header("Location: ../data-list.php?status=inputsuccess");
} else if($input === 'nisn_duplicate'){
    // NISN sudah ada
    header("Location: ../data-input.php?status=nisn_duplicate");
} else {
    // Gagal lainnya
    header("Location: ../data-input.php?status=failed");
}
exit();

?>