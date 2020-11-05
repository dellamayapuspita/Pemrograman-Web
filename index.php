<!DOCTYPE html>
<html>
<head>
	<title>Minimarket Barokah</title>

	<!-- Bootstrap cSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<!-- HEADER -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php"> Selamat Datang di Barokah Minimarket </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSuppportedContent" aria-controls="navbarSuppportedContent" aria-expanded="false" aria-label="Toggle Navigation">
				<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSuppportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php?fungsi=create"> Input Barang Baru </a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<?php

include('koneksi.php');


//Fungsi tambah data

function create($koneksi){

	if(isset($_POST['btn_simpan'])){
		$nomor_sku = $_POST['nomor_sku'];
		$nama_barang = $_POST['nama_barang'];
		$jumlah_stok = $_POST['jumlah_stok'];
		$harga_satuan = $_POST['harga_satuan'];
		$kategori = $_POST['kategori'];

		if(!empty($nomor_sku) && !empty($nama_barang) && !empty($jumlah_stok) && !empty($harga_satuan) && !empty($kategori)){
			$sql = "INSERT INTO barang(no_barang, nomor_sku, nama_barang, jumlah_stok, harga_satuan, kategori) VALUES('','".$nomor_sku."','".$nama_barang."','".$jumlah_stok."','".$harga_satuan."', '".$kategori."')";
			echo $sql;
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['fungsi'])){
				if($_GET['fungsi'] == 'create'){
					header('location: index.php');
				}
			} 
		} else{
			$pesan = "Tidak dapat menyimpan data belum lengkap!";
		}
	}

?>	<!-- NI ADALAH FORM TAMBAH PESERTA -->
	<div class="container" style="margin-top: 20px">
	<h2> Tambah Data Barang </h2>
	<form action="index.php?fungsi=create" method="post">

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Nomor SKU </label>
			<div class="col-sm-10">
				<input type="text" name="nomor_sku" class="form-control" size="20" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Nama Barang </label>
			<div class="col-sm-10">
				<textarea name="nama_barang" class="form-control" required></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Jumlah Stok </label>
			<div class="col-sm-10">
				<textarea name="jumlah_stok" class="form-control" required></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Harga Satuan </label>
			<div class="col-sm-10">
				<textarea name="harga_satuan" class="form-control" required></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Kategori </label>
			<div class="col-sm-10">
				<textarea name="kategori" class="form-control" required></textarea> 
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> &nbsp; </label>
			<div class="col-sm-10">
				<input type="submit" name="btn_simpan" class="btn btn-primary" value="Simpan">
				<input type="reset" name="btn_reset" class="btn btn-info" value="Reset">
				<a href="index.php" class="btn btn-success" role="button"> Kembali </a>
			</div>
		</div>
	</form>

	</div>
	<?php

}




function read($koneksi){
	echo '
	<div class="container" style="marginn-top: 20px">
	<h2> Berikut daftar barang </h2>

	<hr> 

		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th> No. </th>
					<th> Nomor SKU </th>
					<th> Nama Barang </th>
					<th> Jumlah Stok </th>
					<th> Harga Satuan </th>
					<th> Kategori </th>
					<th> Opsi </th>
				</tr>
			</thead>
		<tbody>';

		//query database
		$sql = "SELECT * FROM barang";
		$query = mysqli_query($koneksi, $sql);

			//jika query nilai dibawah if
			if(mysqli_num_rows($query) > 0){
				$no=1;

				while($data = mysqli_fetch_assoc($query)){

					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$data['nomor_sku'].'</td>
						<td>'.$data['nama_barang'].'</td>
						<td>'.$data['jumlah_stok'].'</td>
						<td>'.$data['harga_satuan'].'</td>
						<td>'.$data['kategori'].'</td>

						<td>
							<a href="index.php?fungsi=update&no_barang='.$data['no_barang'].'" class="badge badge-warning"> Edit </a>
							<a href="index.php?fungsi=delete&no_barang='.$data['no_barang'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ini dihapus?\')"> Hapus </a>
						</td>
					</tr>';
					$no++;

				}
				//jika query menghasilkan nilai 0
			}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada Data. </td>
					</tr>
					';
			}
			echo ' 
			<tbody>
		</table>

	</div>';
}

//fungsi ubah data
function update($koneksi){
	if(isset ($_POST['btn_simpan'])){
		$no_barang = $_POST['no_barang'];
		$nomor_sku = $_POST['nomor_sku'];
		$nama_barang = $_POST['nama_barang'];
		$jumlah_stok = $_POST['jumlah_stok'];
		$harga_satuan = $_POST['harga_satuan'];
		$kategori = $_POST['kategori'];


		if(!empty($no_barang) && !empty($nomor_sku) && !empty($nama_barang) && !empty($jumlah_stok) && !empty($harga_satuan) && !empty($kategori)){

			$sql = "UPDATE barang SET nomor_sku='$nomor_sku', nama_barang='$nama_barang', jumlah_stok='$jumlah_stok', harga_satuan='$harga_satuan', kategori='$kategori' WHERE no_barang='$no_barang'";
			echo $sql;
			$update = mysqli_query($koneksi, $sql);
			if($update && isset($_GET['fungsi'])){
				if($_GET['fungsi'] == 'update'){
					header('location: index.php');
				}
			} 
		} else{
			$pesan = "Tidak dapat menyimpan data belum lengkap!";
		}
	} else {
			$no_barang = $_GET['no_barang'];
			//Ambil data peserta untuk ditampilkan ke dalam form update
			$sql_barang = "SELECT * FROM barang WHERE no_barang=". $no_barang;
			$query_barang = mysqli_query($koneksi, $sql_barang);
			$data_barang = mysqli_fetch_assoc($query_barang);
	}
?>
	<div class="container" style="margin-top: 20px">
	<h2> Update Data Barang </h2>
	<form action="index.php?fungsi=update" method="post">

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Nomor SKU </label>
			<div class="col-sm-10">
				<input type="text" name="nomor_sku" class="form-control" size="20" value="<?php echo $data_barang['nomor_sku']; ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Nama Barang </label>
			<div class="col-sm-10">
				<textarea name="nama_barang" class="form-control" required> <?php echo $data_barang['nama_barang']; ?></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Jumlah Stok </label>
			<div class="col-sm-10">
				<textarea name="jumlah_stok" class="form-control" required> <?php echo $data_barang['jumlah_stok']; ?></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Harga Satuan </label>
			<div class="col-sm-10">
				<textarea name="harga_satuan" class="form-control" required> <?php echo $data_barang['harga_satuan']; ?></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> Kategori </label>
			<div class="col-sm-10">
				<textarea name="kategori" class="form-control" required> <?php echo $data_barang['kategori']; ?></textarea> 
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"> &nbsp; </label>
			<div class="col-sm-10">
				<input type="hidden" name="no_barang" value="<?php echo $no_barang; ?>">
				<input type="submit" name="btn_simpan" class="btn btn-primary" value="Simpan">
				<a href="index.php" class="btn btn-success" role="button"> Kembali </a>
			</div>
		</div>
	</form>

	</div>
	<?php

}

//fungsi hapus data
function delete($koneksi){
	if(isset($_GET['no_barang']) && isset($_GET['fungsi'])){
		$no_barang = $_GET['no_barang'];
		$sql_hapus= "DELETE FROM barang WHERE no_barang=" . $no_barang;
		$hapus=mysqli_query($koneksi, $sql_hapus);

		if($hapus){
			if($_GET['fungsi'] == 'delete'){
				header("location: index.php");
			}
		}
	}
}


//program utama
if(isset($_GET['fungsi'])){
	switch ($_GET['fungsi'])
	{
		case "create":
			create($koneksi);
			break;
		case "read":
			read($koneksi);
			break;
		case "update":
			update($koneksi);
			break;
		case "delete":
			delete($koneksi);
			break;
		default:
			read($koneksi);
	}
} else {
	read($koneksi);
}


?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849b1E2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJ0Z+n"crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHsEW1d1vI9IOYy5n3zV9zzTtmI3UksdQRVvoxMdooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/boottrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCEx13Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>