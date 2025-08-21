<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<h3 style="text-align:center">List Data Peserta</h3>

<a href="add.php" style="color:white; background:#047857; padding:6px 12px; text-decoration:none; border:1px solid #065f46; border-radius:3px;">Tambah Peserta</a>
<br><br>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}
table th, table td {
  border: 1px solid #999;
  padding: 8px;
}
table th {
  background: #eee;
}
</style>

<table>
<tr>
  <th>Kode Peserta</th>
  <th>Nama Peserta</th>
  <th>Tanggal Lahir</th>
  <th>Jenis Kelamin</th>
  <th>Alamat</th>
  <th>Aksi</th>
</tr>
<?php
$q = mysqli_query($conn,"SELECT * FROM peserta");
while($row=mysqli_fetch_assoc($q)){
  echo "<tr>
    <td>{$row['kode_peserta']}</td>
    <td>{$row['nama_peserta']}</td>
    <td>{$row['tanggal_lahir']}</td>
    <td>{$row['jenis_kelamin']}</td>
    <td>{$row['alamat']}</td>
    <td>
      <a href='edit.php?id={$row['kode_peserta']}'>Edit</a> | 
      <a href='index.php?del={$row['kode_peserta']}' onclick='return confirm(\"Hapus data?\")'>Del</a>
    </td>
  </tr>";
}
if(isset($_GET['del'])){
  $id = mysqli_real_escape_string($conn,$_GET['del']);
  mysqli_query($conn,"DELETE FROM peserta WHERE kode_peserta='$id'");
  header("Location: index.php"); exit;
}
?>
</table>

<?php include("../includes/footer.php"); ?>
