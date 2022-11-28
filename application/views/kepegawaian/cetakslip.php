
<body>             
    <style type="text/css">
    
            table {
                border-collapse:collapse;
                table-layout:fixed;width: 580px;
                
            }
            table th {
                word-wrap:break-word;
      width: 25%;
    }
    </style>

<br><br><br><br>
<?php 
function rupiah($angka){
    $hasil = number_format($angka,0,',','.');
    return $hasil;
}
?>
<h2 align="center">Data Slip Gaji <br>Periode 26 <?php
$h = date('d');
if($h<=25){
  $kemarin = $gaji['tanggal']-1;
  
}else{
  $kemarin = $gaji['tanggal'];
  $gaji['tanggal'] = $gaji['tanggal']+1;
}

if($kemarin=="1"){
  $kemarin="Januari ";
}else if($kemarin=="2"){
  $kemarin="Februari ";
}else if($kemarin=="3"){
  $kemarin="Maret ";
}else if($kemarin=="4"){
  $kemarin="April ";
}else if($kemarin=="5"){
  $kemarin="Mei ";
}else if($kemarin=="6"){
  $kemarin="Juni ";
}else if($kemarin=="7"){
  $kemarin="Juli";
}else if($kemarin=="10"){
  $kemarin="Oktober ";
}else if($kemarin=="9"){
  $kemarin="September ";
}else if($kemarin=="8"){
  $kemarin="Agustus ";
}else if($kemarin=="11"){
  $kemarin="November ";
}else if($kemarin=="12"){
  $kemarin="Desember ";
}
echo $kemarin;  ?> sampai 25 <?php
 if($gaji['tanggal']=="1"){
      $gaji['tanggal']="Januari ";
    }else if($gaji['tanggal']=="2"){
      $gaji['tanggal']="Februari ";
    }else if($gaji['tanggal']=="3"){
      $gaji['tanggal']="Maret ";
    }else if($gaji['tanggal']=="4"){
      $gaji['tanggal']="April ";
    }else if($gaji['tanggal']=="5"){
      $gaji['tanggal']="Mei ";
    }else if($gaji['tanggal']=="6"){
      $gaji['tanggal']="Juni ";
    }else if($gaji['tanggal']=="7"){
      $gaji['tanggal']="Juli ";
    }else if($gaji['tanggal']=="10"){
      $gaji['tanggal']="Oktober ";
    }else if($gaji['tanggal']=="9"){
      $gaji['tanggal']="September ";
    }else if($gaji['tanggal']=="8"){
      $gaji['tanggal']="Agustus ";
    }else if($gaji['tanggal']=="11"){
      $gaji['tanggal']="November ";
    }else if($gaji['tanggal']=="12"){
      $gaji['tanggal']="Desember ";
    }
    echo $gaji['tanggal'];
?>
<?php $tahun=date('Y');
echo $tahun;?>
</h2>
<?php foreach($jab as $j):?>
                <b>NIP        : <?=$j['nip'];?></b><br>
                <b>NAMA       : <?=$j['nama'];?></b><br>
                <b>Divisi    : <?=$j['nama_jabatan'];?></b><br>
                <b>Gaji Pokok : Rp. <?=rupiah($j['gaji']);?></b><br><br>
                <?php endforeach;?>
    <table class="table align-items-center table-flush" align="center" border="1">
        <tr>
            <td colspan="2" align="center"><b>Rincian Gaji</b></td>
        </tr>
        <tbody class="list">
    <?php
    
        
        $no=1;
        foreach($slip as $data) :?>
           <?php $tgl = date('d-m-Y', strtotime($data['tanggal']));?>
           
            <tr>
                <td align="left">Alpa</td>
                <td align="right"><?=$data['alpa'];?> x Rp. 60.000</td>
            </tr>
            <tr>
                <td align="left">Terlambat</td>
                <td align="right"><?=$data['terlambat'];?> x Rp. 30.000</td>
            </tr>
            <tr>
                <td align="left">Pulang Awal</td>
                <td align="right"><?=$data['pulang_awal'];?> x Rp. 30.000</td>
            </tr>
            <tr>
                <td align="left">Terlambat & Pulang Awal</td>
                <td align="right"><?=$data['terlambat_pulang_awal'];?> x Rp. 60.000</td>
            </tr>
            <tr>
                <td align="left">Tidak Presensi Pulang </td>
                <td align="right"><?=$data['presensi_belum'];?> x Rp. 30.000</td>
            </tr>
            <tr>
                <td align="left">Terlambat & Tidak Presensi Pulang </td>
                <td align="right"><?=$data['terlambat_presensi_belum'];?> x Rp. 60.000</td>
            </tr>
            <tr>
                <td align="left">Potongan</td>
                <td align="right">Rp. <?=rupiah($data['potongan']*30000);?></td>
            </tr>
            <tr>
                <td align="left">Total Gaji</td>
                <td align="right">Rp. <?=rupiah($data['total_gaji']);?></td>
            </tr>
      <?php endforeach; ?>
    <?php
        
        ?>
        </tbody>
    </table>
    *Catatan <br>
    Alpa                       : Rp. 60.000<br>
    Terlambat                  : Rp. 30.000<br>
    Pulang Awal                : Rp. 30.000<br>
    Terlambat & Pulang Awal    : Rp. 60.000<br>
    Tidak Presensi Pulang      : Rp. 30.000<br>
    Terlambat & Tidak Presensi Pulang : Rp. 60.000<br>
    <br>
    <p>
    Bandung, <?=date('d-m-Y');?><br>
    Mengetahui,<br>
    Kepala Bagian Kepegawaian,
    <br><br><br><br>
    <b>Ramdan</b>
    </p>


