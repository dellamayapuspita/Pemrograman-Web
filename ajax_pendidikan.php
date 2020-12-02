<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 


  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['SMP'])) {
          //query SQL
          $SMP = $_GET['SMP'];
          $query = "SELECT * FROM pendidikan WHERE SMP = '$SMP'"; 

          //eksekusi query
          $pendidikan = mysqli_query(connection(),$query);

          while($data = mysqli_fetch_array($pendidikan)){
            echo "<option value='".$data['SD']."'>".$data['content']."</option>";
          }
      }  
  }