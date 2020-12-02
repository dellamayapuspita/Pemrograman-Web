<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 


  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['address'])) {
          //query SQL
          $address = $_GET['address'];
          $query = "SELECT * FROM cv WHERE address = '$address'"; 

          //eksekusi query
          $cv = mysqli_query(connection(),$query);

          while($data = mysqli_fetch_array($cv)){
            echo "<option value='".$data['name']."'>".$data['content']."</option>";
          }
      }  
  }