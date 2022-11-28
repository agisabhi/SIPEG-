<form autocomplete="on" action="<?= base_url(); ?>absen/tambah" method="post">
  <h1>Contoh Autocomplete dan Autofill</h1>
  <a href="<?= base_url(); ?>auth" class="btn btn-danger">LOGIN PEGAWAI</a>
  <div>
    <label>NIP</label><br>
    <input list="data_ma" type="text" name="nip" id="nip" placeholder="nip / nama" onchange="return auto()">
  </div>
  <div>
    <label>NAMA</label><br>
    <input type="text" name="nama" id="nama" readonly>
  </div>
  <div>
    <label>Kode Golongan</label><br>
    <input type="text" name="kode_gol" id="kode_gol" readonly>
  </div>
  <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
                                            echo date("Y-m-d h:i:sa"); ?>">
  <br>
  <input type="hidden" name="tanggal" value="<?= date("Y-m-d"); ?>">
  <br>
  <div>
    <input type="submit" name="submit" value="Absen">
  </div>
</form>

<table border="1">
  <tr>
    <td>NO</td>
    <td>NIP</td>
    <td>NAMA</td>
    <td>Jam Masuk</td>

  </tr>
  <?php $no = 1; ?>
  <?php foreach ($abs as $a) : ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $a['nip']; ?></td>
      <td><?= $a['nama']; ?></td>
      <td><?= $a['waktu']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<datalist id="data_ma">
  <?php
  foreach ($absensi->result() as $b) {
    echo "<option value='$b->nip'>$b->nama</option>";
  }
  ?>

</datalist>
<script src="<?php echo base_url(); ?>assets/ajax.js"></script>


<script>
  function auto() {
    var nip = document.getElementById('nip').value;
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/absen/cari",
      data: '&nip=' + nip,
      success: function(data) {
        var hasil = JSON.parse(data);

        $.each(hasil, function(key, val) {

          document.getElementById('nip').value = val.nip;
          document.getElementById('nama').value = val.nama;
          document.getElementById('kode_gol').value = val.kode_gol;



        });
      }
    });

  }
</script>