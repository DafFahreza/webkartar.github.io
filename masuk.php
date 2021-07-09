<?php 

	//koneksi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "kas2";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

//jika tombol simpan diklik
if (isset($_POST ['bsimpan']))
 {
	$simpan = mysqli_query($koneksi, "INSERT INTO kas ( penanggung, keterangan, tgl, jumlah, jenis, keluar) VALUES 
							   ('$_POST[tpenanggung]', 
                 '$_POST[tketerangan]',
							   '$_POST[ttgl]',
                 '$_POST[tjumlah]',
                  '$_POST[tjenis]',
                 '$_POST[tkeluar]')"); 


if ($simpan)
 {
	echo "<script>
		alert('berhasil disimpan');
		document.location='kas.php';
		</script>";
}
else
{
	echo "<script>
		alert('gagal disimpan');
		document.location='kas.php';
		</script>";
}
}

 ?>

 

<!DOCTYPE html>
<html>
<head>
	<title>KARANTAUNA ALAM CITRA 2021</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="text-center">KARANGTARUNA ALAM CITRA</h1>
<h2 class="text-center">2021</h2>

<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Anggota Karangtaruna
  </div>
  <div class="card-body">
    <form method="post" action="">
    	<div class="form-group">
    		<label>penanggung</label>
    		<input type="text" name="tpenanggung" class="form-control" placeholder="Masukkan penanggung" required>

    		<label class="mt-3">Keterangan</label>
    		<input type="text" name="tketerangan" class="form-control" placeholder="Masukkan keterangan">

    		<label class="mt-3">Tanggal</label>
    		<input type="date" name="ttgl" class="form-control" placeholder="Masukkan tanggal">

    		<label class="mt-3">Jumlah</label>
    		<input type="text" name="tjumlah" class="form-control" placeholder="Masukkan jumlah">

        <label class="mt-3">Jenis</label>
       <select class="form-control" name="tstatus" placeholder="Pilih">
          <option>pilih</option>
          <option value="Masuk">Masuk</option>
          <option value="Keluar">Keluar</option>
        </select>

          <label class="mt-3">Keluar</label>
        <input type="text" name="tkeluar" class="form-control" placeholder="Masukkan keluar">
    	</div>
    	<button type="simpan" class="btn btn-success mt-3" name="bsimpan">Simpan</button>
    	<button type="kosongkan" class="btn btn-danger mt-3" name="breset">Kosongkan</button>
      <button class="btn btn-success mt-3" color="text-white"><a href="index.html">Kembali</a></button>
    </form>
  </div>
</div>

<!-- CARD TABEL !-->
<div class="card mt-3">
  <div class="card-header bg-success text-white">
    Daftar Anggota Karangtaruna
  </div>
  <div class="card-body">

  	<table class="table table-bordered table-striped">
  		<tr> 
  			<th>No.</th>
  			<th>Penanggung</th>
  			<th>Keterangan</th>
  			<th>Tanggal</th>
  			<th>Jumlah</th>
  			<th>Jenis</th>
  		</tr>
  		<?php 
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from  kas order by id desc");
  			while ($data = mysqli_fetch_array($tampil)) :
  				# code...
  			
  		 ?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['penanggung']?></td>
  			<td><?=$data['keterangan']?></td>
  			<td><?=$data['tgl']?></td>
  			<td><?=$data['jumlah']?></td>
        <td><?=$data['jenis']?></td>
  			<td>
  				<a href="#" class="btn btn-warning">Edit</a>
  				<a href="#" class="btn btn-danger">Hapus</a>
  			</td>
  		</tr>
  		<?php endwhile ?>
  	</table>
   
  </div>
</div>

</div>



<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>