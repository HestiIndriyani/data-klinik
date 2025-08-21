<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<h3 style="text-align:center">Tambah Poli</h3>

<style>
.form-box {
  border: 1px solid #1e5c99;
  width: 600px;
  margin: 0 auto;
  padding: 15px;
}
.form-row {
  margin: 10px 0;
}
.form-label {
  display: inline-block;
  width: 150px;
}
input, select, textarea {
  padding: 5px;
  border: 1px solid #1e5c99;
}
button, input[type=submit], input[type=reset], a.btn {
  padding: 5px 20px;
  border: 1px solid #1e5c99;
  background: #3b82f6;
  color: white;
  margin: 15px 10px 0 0;
  cursor: pointer;
  text-decoration: none;
}
button:hover, input[type=submit]:hover, input[type=reset]:hover, a.btn:hover {
  background: #2563eb;
}
</style>

<div class="form-box">
  <form method="POST">
    <div class="form-row">
      <span class="form-label">Kode Poli</span>
      <input type="text" name="kode" required>
    </div>

    <div class="form-row">
      <span class="form-label">Nama Poli</span>
      <input type="text" name="nama" required>
    </div>

    <div class="form-row">
      <input type="submit" name="simpan" value="Simpan">
      <input type="reset" value="Clear">
      <a href="list.php" class="btn">Lihat Data Poli</a>
    </div>
  </form>
</div>

<?php
if(isset($_POST['simpan'])){
    $kode  = mysqli_real_escape_string($conn,$_POST['kode']);
    $nama  = mysqli_real_escape_string($conn,$_POST['nama']);

    $sql = "INSERT INTO poli (kode_poli,nama_poli) VALUES ('$kode','$nama')";
    
    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;text-align:center'>Data berhasil disimpan</p>";
    } else {
        echo "<p style='color:red;text-align:center'>Error: ".mysqli_error($conn)."</p>";
    }
}
?>

<?php include("../includes/footer.php"); ?>
