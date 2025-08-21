<?php include("../config/database.php"); ?>
<?php include("../includes/header.php"); ?>

<h3 style="text-align:center">Tambah Rekam Medis</h3>

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
      <input type="text" name="no_transaksi" required>
    </div>

    <div class="form-row">
      <span class="form-label">Nama Peserta</span>
      <select name="kode_peserta" required>
        <option value="">---Pilih Peserta---</option>
        <?php
        $q = mysqli_query($conn,"SELECT * FROM peserta");
        while($p=mysqli_fetch_assoc($q)){
          echo "<option value='{$p['kode_peserta']}'>{$p['nama_peserta']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-row">
      <span class="form-label">Tanggal Berobat</span>
      <select name="tanggal">
        <option value="">--Tanggal--</option>
        <?php for($i=1;$i<=31;$i++){ 
          $val = str_pad($i,2,"0",STR_PAD_LEFT);
          echo "<option value='$val'>$val</option>"; 
        } ?>
      </select>
      <b>Bulan</b>
      <select name="bulan">
        <option value="">--Bulan--</option>
        <?php 
        $bulan=["01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni",
                "07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember"];
        foreach($bulan as $val=>$nama) echo "<option value='$val'>$nama</option>";
        ?>
      </select>
      <b>Tahun</b>
      <input type="text" name="tahun" value="<?= date('Y') ?>" size="6">
    </div>

    <div class="form-row">
      <span class="form-label">Nama Bidan</span>
      <select name="kode_bidan" required>
        <option value="">---Pilih Bidan---</option>
        <?php
        $q = mysqli_query($conn,"SELECT * FROM bidan");
        while($b=mysqli_fetch_assoc($q)){
          echo "<option value='{$b['kode_bidan']}'>{$b['nama_bidan']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-row">
      <span class="form-label">Keluhan</span>
      <input type="text" name="keluhan">
    </div>

    <div class="form-row">
      <span class="form-label">Biaya Administrasi</span>
      <input type="number" name="biaya">
    </div>

    <div class="form-row">
      <input type="submit" name="simpan" value="Submit">
      <input type="reset" value="Clear">
      <a href="index.php" class="btn">Lihat Data Rekam Medis</a>
    </div>
  </form>
</div>

<?php
if(isset($_POST['simpan'])){
    $no     = mysqli_real_escape_string($conn,$_POST['no_transaksi']);
    $peserta= mysqli_real_escape_string($conn,$_POST['kode_peserta']);
    $bidan  = mysqli_real_escape_string($conn,$_POST['kode_bidan']);
    $keluhan= mysqli_real_escape_string($conn,$_POST['keluhan']);
    $biaya  = mysqli_real_escape_string($conn,$_POST['biaya']);
    $tgl    = $_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'];

    $sql = "INSERT INTO rekamMedis 
            (no_transaksi, kode_peserta, tanggal_berobat, kode_bidan, keluhan, biaya_admin) 
            VALUES 
            ('$no','$peserta','$tgl','$bidan','$keluhan','$biaya')";
    
    if(mysqli_query($conn,$sql)){
        echo "<p style='color:green;text-align:center'>Data berhasil disimpan</p>";
    } else {
        echo "<p style='color:red;text-align:center'>Error: ".mysqli_error($conn)."</p>";
    }
}
?>

<?php include("../includes/footer.php"); ?>
