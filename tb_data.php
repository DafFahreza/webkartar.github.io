<?php
  include ('koneksi.php');
  include ('function.php');
?>
<?php
//set variabel
$nama = $foto = $berhasil_simpan = $berhasil_simpan_err = $nama_err = $foto_err ="";   
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST['nama']))){
           $nama_err = "Nama Anggota tidak boleh kosong";     
           }elseif(strlen($_POST['nama'])>25){
           $nama_err = "Nama Anggota tidak boleh lebih dari 25 karakter ";
           }else{
           $nama=test_input($_POST['nama']);
           $nama=mysqli_real_escape_string($koneksi,$nama);
    }

      $imgFile = $_FILES['foto']['name'];
      $tmp_dir = $_FILES['foto']['tmp_name'];
      $imgSize = $_FILES['foto']['size'];
      //letak direktori gambar
      $upload_dir = 'folderfoto/';
      //variabel pengecekan ektensi gambar
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
      //Merename gambar secara random
      $item_foto = rand(1000,1000000).".".$imgExt; 
      if (!empty($_FILES["foto"]["tmp_name"])){
      if(in_array($imgExt, $valid_extensions)){  
      if(!$imgSize< 2000000){
      $foto=$tmp_dir;
      }else{
      $foto_err="Maaf file foto terlalu besar. Max 2MB"; 
      } 
      }else{
      $foto_err="Maaf ektensi foto tidak sesuai ketentuan";
      }
      }else{
      $foto_err = "Maaf Foto masih kosong";
      }

  //Jika data error kosong maka eksekusi ke database
  if(empty($nama_err) && empty($foto_err) && empty($id_err)){
       
           if(simpan_foto($nama, $foto)){
              $berhasil_simpan = "Data berhasil disimpan <a href='lihat.php'>Lihat Data</a>";
              }else{
              $berhasil_simpan_err = "Data gagal disimpan";
              }

  }


}
?>

<html>
<head>
<title>DATA KARANGTARUNA</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
.error-form {color: red;}
.sukses-form{color: #0081ff;}
</style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="page-header">
      <h1>Data Karangtaruna</h1>
    </div>
<p class="sukses-form"><?php echo $berhasil_simpan; ?></p>
<p class="error-form"><?php echo $berhasil_simpan_err; ?></p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
  <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
      <label>Nama Anggota Karangtaruna :</label>
      <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Anggota" value="<?php echo $nama; ?>">
      <span><p class="error-form"><?php echo $nama_err; ?></p></span>    
  </div>
  <div class="form-group <?php echo (!empty($foto_err)) ? 'has-error' : ''; ?>">
      <label>Foto Anggota Karangtaruna</label>   
      <input type="file" class="form-control-file" id="foto" name="foto">
      <span><p class="error-form"><?php echo $foto_err; ?></p></span>  
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</body>
</html>
