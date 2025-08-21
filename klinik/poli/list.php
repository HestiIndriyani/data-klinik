<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<h3 style="text-align:center">List Data Poli</h3>

<a href="add.php" style="color:white; background:#047857; padding:6px 12px; text-decoration:none; border:1px solid #065f46; border-radius:3px;">Tambah Poli</a>
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
  <th>Kode Poli</th>
  <th>Nama Poli</th>
  <th>Aksi</th>
</tr>
<?php
$q = mysqli_query($conn,"SELECT * FROM poli");
while($row=mysqli_fetch_assoc($q)){
  echo "<tr>
    <td>{$row['kode_poli']}</td>
    <td>{$row['nama_poli']}</td>
    <td>
      <a href='edit.php?id={$row['kode_poli']}'>Edit</a> | 
      <a href='list.php?del={$row['kode_poli']}' onclick='return confirm(\"Hapus data?\")'>Del</a>
    </td>
  </tr>";
}
if(isset($_GET['del'])){
  $id = mysqli_real_escape_string($conn,$_GET['del']);
  mysqli_query($conn,"DELETE FROM poli WHERE kode_poli='$id'");
  header("Location: list.php"); exit;
}
?>
</table>

<?php include("../includes/footer.php"); ?>
