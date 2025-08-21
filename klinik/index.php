<?php include("includes/header.php"); ?>

<style>
.menu-container {
  width: 400px;
  margin: 0 auto;
  text-align: left;
}
.box {
  border: 1px solid black;
  margin: 15px 0;
  padding: 0;
}
.box-header {
  background: #555;
  color: white;
  font-weight: bold;
  padding: 5px 10px;
}
.box-content {
  padding: 10px;
}
.box-content b {
  display: block;
  margin-bottom: 5px;
}
.box-content a {
  display: block;
  color: black;
  text-decoration: none;
  margin: 3px 0;
}
.box-content a:hover {
  text-decoration: underline;
}
</style>

<div class="menu-container">
  <div class="box">
    <div class="box-header">MENU</div>
    <div class="box-content">
      <b>Form</b>
      <a href="peserta/list.php">Data Peserta</a>
      <a href="bidan/list.php">Data Bidan</a>
      <a href="poli/list.php">Data Poli</a>
      <a href="rekam_medis/index.php">Data Rekam Medis</a>
    </div>
  </div>

  <div class="box">
    <div class="box-content">
      <b>Laporan</b>
      <a href="bidan/list.php">List Bidan</a>
      <a href="peserta/list.php">List Peserta</a>
      <a href="rekam_medis/index.php">List Data Rekam Medis</a>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
