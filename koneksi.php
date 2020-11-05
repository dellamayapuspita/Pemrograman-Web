<?php
      $koneksi = mysqli_connect("localhost", "root", "", "minimarket");

      if(mysqli_connect_errno()){
      	echo "gagal terhubung dengan database MySQL :" .mysqli_connect_error();
      }
?>
