<?php
$host = "localhost"; // Nama hostnya
$username = "root"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "cv"; // Nama databasenya
$connect = mysqli_connect($host, $username, $password, $database); // Koneksi ke MySQL

if( !$connect ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>