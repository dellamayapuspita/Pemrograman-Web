<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
  $query_cv = "SELECT * FROM cv"; 
  $query_pendidikan = "SELECT * FROM pendidikan";
  //eksekusi query

?>
<!DOCTYPE html>
<html>

<head>
	<title>CURRICULUM VITAE</title>
	
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	
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
		
		
<form>
		CV : 
		<select id="cv">
			<option value="">--- PILIH ---</option>
			<?php while($data = mysqli_fetch_array($cv)): ?>
				<option value="<?php echo $data['name'] ?>"><?php echo  $data['content']?></option>
			<?php endwhile; ?>
		</select>
		<br>

		
		

	
	
	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">
		</div>
	</div>

		Pendidikan:
		<select id="pendidikan">
			<option value="">--- PILIH CV dahulu---</option>
		</select>
		<span id="load_pendidikan" style="display: none;">Loading Pendidikan...</span>
		<br>




	
	<div class="container_12" style="border: 1px solid #000;">
		<div class="grid_12" style="background: gray;">
		</div>
	</div>
	
</form>


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

 
</center> 
	
<body>
</html>

<script type="text/javascript">

	$("#cv").on("change",function(){
		$("#load_pendidikan").show();
		var name= $("#cv").val();
        $.ajax({
            type: "GET",
            url: "ajax_pendidikan.php?SMP=" + SMP,
            success: function(msg){
                $("#load_pendidikan").hide();
                $('#pendidikan').html(msg);
            }	
        });
	});

	$("#pendidikan").on("change",function(){
		$("#load_cv").show();
		var address= $("#pendidikan").val();
        $.ajax({
            type: "GET",
            url: "ajax_cv.php?address=" + address,
            success: function(msg){
                $("#load_cv").hide();
                $('#cv').html(msg);
            }	
        });
	});


    
</script>