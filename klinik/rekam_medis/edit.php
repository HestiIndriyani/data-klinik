<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<?php
if(!isset($_GET['id'])){
  header("Location: index.php");
  exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$q = mysqli_query($conn,"SELECT * FROM rekamMedis WHERE no_transaksi='$id'");
$data = mysqli_fetch_assoc($q);

if(!$data){
  echo "<p style='color:red;text-align:center'>Data tidak ditemukan!</p>";
  include("../includes/footer.php");
  exit;
}
?>

<h3 style="text-align:center">Edit Rekam Medis</h3>

<style>
.form-box {
  border: 1px solid #1e5c99;
  width: 800px;
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
      <span class="form-label">No Transaksi</span>
      <input type="text" name="no_transaksi" value="<?= $data['no_transaksi'] ?>" readonly>
    </div>

    <div class="form-row">
      <span class="form-label">Nama Peserta</span>
      <select name="kode_peserta" required>
        <option value="">---Pilih Peserta---</option>
        <?php
        $q = mysqli_query($conn,"SELECT * FROM peserta");
        while($p=mysqli_fetch_assoc($q)){
          $sel = ($p['kode_peserta']==$data['kode_peserta']) ? "selected" : "";
          echo "<option value='{$p['kode_peserta']}' $sel>{$p['nama_peserta']}</option>";
        }
        ?>
      </select>
    </div>

    <?php 
      $tgl = explode("-",$data['tanggal_berobat']); 
      $thn = $tgl[0]; $bln = $tgl[1]; $hr = $tgl[2];
    ?>
    <div class="form-row">
      <span class="form-label">Tanggal Berobat</span>
      <select name="tanggal">
        <?php for($i=1;$i<=31;$i++){ 
          $val = str_pad($i,2,"0",STR_PAD_LEFT);
          $sel = ($val==$hr) ? "selected" : "";
          echo "<option value='$val' $sel>$val</option>"; 
        } ?>
      </select>
      <b>Bulan</b>
      <select name="bulan">
        <?php 
        $bulan=["01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni",
                "07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember"];
        foreach($bulan as $val=>$nama){
          $sel = ($val==$bln) ? "selected" : "";
          echo "<option value='$val' $sel>$nama</option>";
        }
        ?>
      </select>
      <b>Tahun</b>
      <input type="text" name="tahun" value="<?= $thn ?>" size="6">
    </div>

    <div class="form-row">
      <span class="form-label">Nama Bidan</span>
      <select name="kode_bidan" required>
        <option value="">---Pilih Bidan---</option>
        <?php
        $q = mysqli_query($conn,"SELECT * FROM bidan");
        while($b=mysqli_fetch_assoc($q)){
          $sel = ($b['kode_bidan']==$data['kode_bidan']) ? "selected" : "";
          echo "<option value='{$b['kode_bidan']}' $sel>{$b['nama_bidan']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-row">
      <span class="form-label">Keluhan</span>
      <input type="text" name="keluhan" value="<?= $data['keluhan'] ?>">
    </div>

    <div class="form-row">
      <span class="form-label">Biaya Administrasi</span>
      <input type="number" name="biaya" value="<?= $data['biaya_admin'] ?>">
    </div>

    <div class="form-row">
      <input type="submit" name="update" value="Update">
      <a href="index.php" class="btn">Kembali ke List</a>
    </div>
  </form>
</div>

<?php
if(isset($_POST['update'])){
    $peserta= mysqli_real_escape_string($conn,$_POST['kode_peserta']);
    $bidan  = mysqli_real_escape_string($conn,$_POST['kode_bidan']);
    $keluhan= mysqli_real_escape_string($conn,$_POST['keluhan']);
    $biaya  = mysqli_real_escape_string($conn,$_POST['biaya']);
    $tgl    = $_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'];

    $sql = "UPDATE rekamMedis SET 
              kode_peserta='$peserta',
              tanggal_berobat='$tgl',
              kode_bidan='$bidan',
              keluhan='$keluhan',
              biaya_admin='$biaya'
            WHERE no_transaksi='$id'";
    
    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;text-align:center'>Data berhasil diupdate</p>";
    } else {
        echo "<p style='color:red;text-align:center'>Error: ".mysqli_error($conn)."</p>";
    }
}
?>

<?php include("../includes/footer.php"); ?>
