<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<?php
if(!isset($_GET['id'])){
  header("Location: index.php");
  exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$q = mysqli_query($conn,"SELECT * FROM poli WHERE kode_poli='$id'");
$data = mysqli_fetch_assoc($q);

if(!$data){
  echo "<p style='color:red;text-align:center'>Data tidak ditemukan!</p>";
  include("../includes/footer.php");
  exit;
}
?>

<h3 style="text-align:center">Edit Poli</h3>

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
input {
  padding: 5px;
  border: 1px solid #1e5c99;
}
button, input[type=submit], a.btn {
  padding: 5px 20px;
  border: 1px solid #1e5c99;
  background: #3b82f6;
  color: white;
  margin: 15px 10px 0 0;
  cursor: pointer;
  text-decoration: none;
}
button:hover, input[type=submit]:hover, a.btn:hover {
  background: #2563eb;
}
</style>

<div class="form-box">
  <form method="POST">
    <div class="form-row">
      <span class="form-label">Kode Poli</span>
      <input type="text" name="kode" value="<?= $data['kode_poli'] ?>" readonly>
    </div>

    <div class="form-row">
      <span class="form-label">Nama Poli</span>
      <input type="text" name="nama" value="<?= $data['nama_poli'] ?>">
    </div>

    <div class="form-row">
      <input type="submit" name="update" value="Update">
      <a href="list.php" class="btn">Lihat Data Poli</a>
    </div>
  </form>
</div>

<?php
if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $sql = "UPDATE poli SET nama_poli='$nama' WHERE kode_poli='$id'";

    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;text-align:center'>Data berhasil diupdate</p>";
    } else {
        echo "<p style='color:red;text-align:center'>Error: ".mysqli_error($conn)."</p>";
    }
}
?>

<?php include("../includes/footer.php"); ?>
