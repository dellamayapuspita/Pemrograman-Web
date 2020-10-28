<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>


<!DOCTYPE html>
<html>

<head>
	<title>CURRICULUM VITAE</title>

	<style type="text/css">
	body { 
	background-color: white;
	}
	</style>

	<link rel="stylesheet" type="text/css" href="960.css">

</head>

<body>

<center>

	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">
		<img src="del.jpg" height="250" width="250">
		</div>
	</div>
	
	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">
		
		
<?php 
$query = mysqli_query($connect, "SELECT * FROM del");
$no=0;
while($data = mysqli_fetch_array($query)){
?>
<tr>
<td><?= $data['name'] ?></td>
<td><?= $data['address'] ?></td>
<td><?= $data['phone'] ?></td>
<td><?= $data['email'] ?></td>
</tr>
<?php } ?>
		
		
		</div>
	</div>
	
</center>
	
	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">
		
<h4><u>Pendidikan:</u></h4>


<?php 
$query = mysqli_query($connect, "SELECT * FROM pendidikan");
$no=0;
while($data = mysqli_fetch_array($query)){
?>
<tr>
<td><?= $data['SD'] ?></td>
<td><?= $data['SMP'] ?></td>
<td><?= $data['SMA'] ?></td>
<td><?= $data['S1'] ?></td>
</tr>
<?php } ?>


		</div>
	</div>
	
	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">

<h4><u>Keahlian:</u></h4>

		<?php
		$O= "Organisasi";
		$K= "Kemampuan Berbicara";
		$MW= "Ms. Word";
		$MP= "Ms. Power Point";
		$ME= "Ms. Excel";
		$A= "Adobe Photosop";
		$H= "HTML";
		$C= "CSS";

		echo "$O		:	*****</br>";
		echo "$K		:	****</br>";
		echo "$MW		:	****</br>";
		echo "$MP		:	****</br>";
		echo "$ME		:	***</br>";
		echo "$A		:	***</br>";
		echo "$H		:	***</br>";
		echo "$C		:	***";
		
		?>
		
		</div>	 
	</div>

</body>
</html>