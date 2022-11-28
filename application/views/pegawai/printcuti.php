<body>
    <style type="text/css">
    
            table {
                border-collapse:collapse;
                table-layout:fixed;width: 600px;
                
            }
            table th {
                word-wrap:break-word;
      width: 100%;
    }
    </style>
    <p>Bandung, <?=$cuti['tanggal_mulai'];?><br>
    Perihal : Permohonan Cuti <?=$cuti['alasan'];?><br> <br>
    Kepada Yth,<br>
    Kepala Bagian Kepegawaian Villa Kancil Kamporng Sunda <br>
    di <br>
    Tempat</p><br>
    <p>Yang bertanda tangan di bawah ini :</p>
    <table>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?=$cuti['nip'];?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?=$cuti['nama'];?></td>
        </tr>
        <tr>
            <td>Tanggal Mulai</td>
            <td>:</td>
            <td><?=date('d-m-Y',strtotime($cuti['tanggal_mulai']));?></td>
        </tr>
        <tr>
            <td>Tanggal selesai</td>
            <td>:</td>
            <td><?=date('d-m-Y',strtotime($cuti['tanggal_selesai']))?></td>
        </tr>
    </table>
    <br>
    <p align="justify">Dengan ini mengajukan cuti untuk kepentingan <?=$cuti['alasan'];?> selama <?php if($cuti['alasan']=="Menikah"){
        ?>7 hari.
        <?php
    }else{
        ?>3 Bulan.
        <?php
    }?> Demikian surat permohonan cuti ini saya ajukan, atas perhatiannya saya ucapkan terimakasih. </p><br>
    <table>
        <tr>
            <td>Kepala Bagian Kepegawaian,</td>
            <td align="right">Yang Mengajukan,</td>
        </tr>
        <tr>
            <td><br><br><br><b>Ramdan</b></td>
            <td align="right"><br><br><br><b><?=$cuti['nama'];?></b></td>
        </tr>
    </table>

</body>

