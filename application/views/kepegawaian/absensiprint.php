
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

<p align="center"><?=$ket;?> Dengan NIP : <?=$nip?></p>
    <table class="table align-items-center table-flush" align="center" border="1">
        <tr>
            <td align="center"><b>No</b></td>
            <td align="center"><b>Tanggal</b></td>
            <td align="center"><b>NIP</b></td>
            <td align="center"><b>NAMA</b></td>
            <td align="center"><b>Waktu Masuk</b></td>
            <td align="center"><b>Waktu Keluar</b></td>
            <td align="center"><b>Status</b></td>
            <td align="center"><b>Keterangan</b></td>
        </tr>
        <tbody class="list">
    <?php
    if( ! empty($transaksi)){
        
        $no=1;
        foreach($transaksi as $data) :?>
           <?php $tgl = date('d-m-Y', strtotime($data['tanggal']));?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$tgl;?></td>
                <td><?=$data['nip'];?></td>
                <td><?=$data['nama'];?></td>
                <td><?=$data['waktu_masuk'];?></td>
                <td><?=$data['waktu_keluar'];?></td>
                <td>
                    <?php
                    if($data['id_status']==1 || $data['id_status']==2 || $data['id_status']==3 || $data['id_status']==4 || $data['id_status']==5 || $data['id_status']==9 || $data['id_status']==11){
                       ?><span class="badge badge-success">HADIR</span><?php 
                    }else if($data['id_status']==7){
                    ?><span class="badge badge-info">Izin</span><?php
                }else if($data['id_status']==8){
                    ?><span class="badge badge-info">Sakit</span><?php
                }else{
                    ?><span class="badge badge-danger">TIDAK HADIR</span><?php
                }?>
                   
                </td>
                <td><?php if($data['id_status']==1){
                    ?><span class="badge badge-success">Tepat Waktu</span><?php
                }else if($data['id_status']==2){
                    ?><span class="badge badge-default">Terlambat Datang</span><?php
                }else if($data['id_status']==3){
                    ?><span class="badge badge-default">Pulang Awal</span><?php
                }else if($data['id_status']==4){
                    ?><span class="badge badge-default">Terlambat & Pulang Awal</span><?php
                }else if($data['id_status']==9){
                    ?><span class="badge badge-info">Tidak Presensi Pulang</span><?php
                }else if($data['id_status']==10){
                    ?><span class="badge badge-info">terlambat & Tidak Presensi Pulang</span><?php
                }else if($data['id_status']==11){
                    ?><span class="badge badge-info">Sedang Cuti</span><?php
                }else{
                    ?><span class="badge badge-danger">TIDAK HADIR</span><?php
                }?></td>
            </tr>
      <?php endforeach; ?>
    <?php
        }
        ?>
        </tbody>
    </table>
    <br>
    <p>
    Bandung, <?=date('d-m-Y');?><br>
    Mengetahui,<br>
    Kepala Bagian Kepegawaian, </p><p align="right">Pemilik,</p><p>
    <br><br><br>
    <b>Ramdan</b></p><p align="right"><b>H. Johan</b></p>


