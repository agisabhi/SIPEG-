<body>             
    <style type="text/css">
    table {
                border-collapse:collapse;
                table-layout:fixed;width: 900px;
            }
            table th {
                word-wrap:break-word;
      width: 25%;
    }

    </style>
<p align="center"><b><?=$ket;?></b></p>
    <table class="table align-items-center table-flush" align="center" border="1">
        <tr>
            <td align="center"><b>No</b></td>
            <td align="center"><b>NIP</b></td>
            <td align="center"><b>NAMA</b></td>
            <td align="center"><b>Jabatan</b></td>
            <td align="center"><b>Tanggal Mulai</b></td>
            <td align="center"><b>Tanggal Selesai</b></td>
            <td align="center"><b>Alasan</b></td>
        </tr>
        <tbody class="list">
    <?php
    if( ! empty($transaksi)){
        
        $no=1;
        foreach($transaksi as $data) :?>
           <?php $tgl_mulai = date('d-m-Y', strtotime($data['tanggal_mulai']));
                $tgl_selesai = date('d-m-Y', strtotime($data['tanggal_selesai']));
           ?>
            <tr>
                <td align="center"><?=$no++;?></td>
                <td><?=$data['nip'];?></td>
                <td><?=$data['nama'];?></td>
                <td><?=$data['nama_jabatan'];?></td>
                <td><?=$tgl_mulai;?></td>
                <td><?=$tgl_selesai;?></td>
                <td><?=$data['alasan'];?></td>
            </tr>
      <?php endforeach; ?>
    <?php
        }
        ?>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <td colspan="2" align="left">Bandung, <?=date('d-m-Y');?></td>
        </tr>
        <tr>
            <td colspan="2">Mengetahui,</td>
        </tr>
        <tr>
            <td>Kepala Bagian Kepegawaian,</td>
            <td align="right">Pemilik,</td>
        </tr>
        <tr>
            <td><br><br><br><b>Ramdan</b></td>
            <td align="right"><br><br><br><b>H. Johan</b></td>
        </tr>
    </table>


