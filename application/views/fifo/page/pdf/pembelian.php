<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Fifo</title>
    <style>
        body {
            margin: -40px;
            /* ashiaap EZ*/
            font-family: Arial, Helvetica, sans-serif;
        }

        .f14 {
            font-size: 14px;
        }

        .f12 {
            font-size: 12px;
        }

        .f10 {
            font-size: 10px;
        }

    </style>
</head>

<body style="padding: 0 10px 0 10px;">
    <!-- HALAMAN 1 GAN -->
    <div style="">
        <table style="width: 100%;">
            <tr>
                <td style="width: 20%;text-align: left;">
                    <img src="<?=base_url()?>assets/images/logo/logo.png" width="100px" alt="">
                </td>
                <td style="width: 60%;text-align: center; padding-left: 10px;">
                    <div style="margin-bottom: 3px;"><b style="font-size: 20px;">PT SUMBER ALFARIA TRIJAYA TBK</b><br></div>
                    <span style="font-size: 10px;">
                    Kawasan Industri Tugu Wijaya Kusuma, Jl. Tugu Industri I No.1, Randu Garut, Kec. Tugu, Kota Semarang, Jawa Tengah 50152</span>
                </td>
                <td style="width: 20%;text-align: center;font-size: 11px;vertical-align: text-top;">
                    <b>AM-05-02f/R0</b></td>
            </tr>
        </table>
    </div>
    <div style="padding: 0px 5px 0 5px;">
        <hr>
    </div>
    <div style="text-align: center;">
        <span style="font-size: 13px; text-transform: uppercase;">
            <b>LAPORAN DATA BARANG MASUK</b><br>
        </span>
    </div>
    <br>
    <div style="padding: 0px 5px 0 5px;">
        <table border="1px" style="font-size: 10px;border: 1px solid black; width: 100%;border-collapse: collapse;text-align: center;" class="f12">
            <tr>
                <th>No</th>
                <th>Faktur Pembelian</th>
                <th>Nama Barang</th>
                <th>Suplier</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>C2</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
            <?php
                $no=1; 
                foreach($pembelian as $data){
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$data->faktur?></td>
                <td><?=$data->barang?></td>
                <td><?=$data->suplier?></td>
                <td><?=date('d M Y', strtotime($data->tgl))?></td>
                <td><?=$data->c2?></td>
                <td><?=$data->pembelian->jumlah?></td>
                <td><?=number_format($data->pembelian->harga)?></td>
                <td><?=number_format($data->pembelian->harga*$data->pembelian->jumlah)?></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <br>
        <table style="margin-top: 15px; width: 100%;border-collapse: collapse;" class="f12">
            <tr>
                <td style="width: 60%;">
                </td>
                <td style="width: 40%; text-align: center;">
                    <br>
                    <span>Semarang, <?=date('d M Y')?></span><br>
                    <span>Kepala Gudang</span>
                    <br><br><br><br>
                    <span><b>___________</b></span>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
