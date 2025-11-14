<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Mahasiswa
$siswa = new siswa();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataSiswa = [
    'id_siswa' => $_POST['id_siswa'],
    'nisn' => $_POST['nisn'],
    'nama' => $_POST['nama_siswa'],
    'jurusan' => $_POST['jurusan'],
    'alamat' => $_POST['alamat'],
    'email' => $_POST['email'],
    'telp_wali' => $_POST['telp_wali'],
    'status_pelajar' => $_POST['status_pelajar']
];
// Memanggil method editMahasiswa untuk mengupdate data mahasiswa dengan parameter array $dataMahasiswa
$edit = $siswa->editSiswa($dataSiswa);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit === true){
    // Berhasil
    header("Location: ../data-list.php?status=editsuccess");
} else if($edit === 'nisn_duplicate'){
    // NISN sudah dipakai siswa lain
    header("Location: ../data-edit.php?id=".$dataSiswa['id_siswa']."&status=nisn_duplicate");
} else {
    // Gagal lainnya
    header("Location: ../data-edit.php?id=".$dataSiswa['id_siswa']."&status=failed");
}
exit();

?>