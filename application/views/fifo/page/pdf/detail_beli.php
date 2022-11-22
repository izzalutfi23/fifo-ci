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
            <b>LAPORAN DATA PEMBELIAN</b><br>
        </span>
        <?php 
            if($from != null){
        ?>
        <span style="font-size: 10px; text-transform: uppercase;">
            <b><?=date('d M Y', strtotime($from))?> s/d <?=date('d M Y', strtotime($to))?></b><br>
        </span>
        <?php } ?>
    </div>
    <br>
    <div style="padding: 0px 5px 0 5px;">
        <table border="1px" style="font-size: 10px;border: 1px solid black; width: 100%;border-collapse: collapse;text-align: center;" class="f12">
            <tr>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">No</th>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">Faktur</th>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">Tgl</th>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">Toko</th>
                <th style="border: 1px solid #000; padding: 5px;" colspan="5">Detail</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000; padding: 5px;">Nama Barang</th>
                <th style="border: 1px solid #000; padding: 5px;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 5px;">C2</th>
                <th style="border: 1px solid #000; padding: 5px;">Harga Satuan</th>
                <th style="border: 1px solid #000; padding: 5px;">SubTotal</th>
            </tr>
            <?php
                $no=1; 
                $total = 0;
                foreach($pembelian as $data){
            ?>
            <?php
                $no1 = 0;
                foreach($data->detail as $detail){
                $no1++;
                $total += $detail->harga*$detail->jumlah;
            ?>
                <tr>
                    <?php 
                        if($no1 == 1){
                    ?>
                    <td style="border: 1px solid #000; padding: 5px;" rowspan="<?=$data->jml?>"><?=$no++?></td>
                    <td style="border: 1px solid #000; padding: 5px;" rowspan="<?=$data->jml?>"><?=$data->faktur?></td>
                    <td style="border: 1px solid #000; padding: 5px;" rowspan="<?=$data->jml?>"><?=date('d M Y', strtotime($data->tgl))?></td>
                    <td style="border: 1px solid #000; padding: 5px;" rowspan="<?=$data->jml?>"><?=$data->nama?></td>
                    <?php } ?>
                    <td style="border: 1px solid #000; padding: 5px;"><?=$detail->nama?></td>
                    <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$detail->jumlah?></td>
                    <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$detail->c2?></td>
                    <td style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($detail->harga)?></td>
                    <td style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($detail->harga*($detail->jumlah * $detail->c2))?></td>
                </tr>
            <?php } ?>
            <?php } ?>
            <tr>
                <th style="border: 1px solid #000; padding: 5px;" colspan="8">Total</th>
                <th style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($total)?></th>
            </tr>
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
