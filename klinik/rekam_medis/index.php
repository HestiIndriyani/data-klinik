<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<h3 style="text-align:center">List Data Rekam Medis</h3>

<a href="add.php" style="color:white; background:#047857; padding:6px 12px; text-decoration:none; border:1px solid #065f46; border-radius:3px;">Tambah Rekam Medis</a>
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
  <th>No Transaksi</th>
  <th>Kode Peserta</th>
  <th>Nama Peserta</th>
  <th>Usia</th>
  <th>Jenis Kelamin</th>
  <th>Keluhan</th>
  <th>Nama Poli</th>
  <th>Nama Bidan</th>
  <th>Biaya Admin</th>
  <th>Aksi</th>
</tr>
<?php
$sql = "SELECT r.no_transaksi, r.keluhan, r.biaya_admin,
               p.kode_peserta, p.nama_peserta,
               TIMESTAMPDIFF(YEAR, p.tanggal_lahir, CURDATE()) AS usia,
               p.jenis_kelamin,
               po.nama_poli, b.nama_bidan
        FROM rekamMedis r
        JOIN peserta p ON r.kode_peserta = p.kode_peserta
        JOIN bidan b ON r.kode_bidan = b.kode_bidan
        JOIN poli po ON b.kode_poli = po.kode_poli";
$q = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($q)){
  echo "<tr>
    <td>{$row['no_transaksi']}</td>
    <td>{$row['kode_peserta']}</td>
    <td>{$row['nama_peserta']}</td>
    <td>{$row['usia']}</td>
    <td>{$row['jenis_kelamin']}</td>
    <td>{$row['keluhan']}</td>
    <td>{$row['nama_poli']}</td>
    <td>{$row['nama_bidan']}</td>
    <td>{$row['biaya_admin']}</td>
    <td>
      <a href='edit.php?id={$row['no_transaksi']}'>Edit</a> | 
      <a href='list.php?del={$row['no_transaksi']}' onclick='return confirm(\"Hapus data?\")'>Del</a>
    </td>
  </tr>";
}

if(isset($_GET['del'])){
  $id = mysqli_real_escape_string($conn,$_GET['del']);
  mysqli_query($conn,"DELETE FROM rekamMedis WHERE no_transaksi='$id'");
  header("Location: list.php"); exit;
}
?>
</table>

<?php include("../includes/footer.php"); ?>
