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
            <b>LAPORAN STOK BARANG MASUK DAN KELUAR</b><br>
            <b>JENIS BARANG: <?=$barang->nama?></b>
        </span>
    </div>
    <br>
    <div style="padding: 0px 5px 0 5px;">
        <table border="1px" style="font-size: 10px;border: 1px solid black; width: 100%;border-collapse: collapse;text-align: center;" class="f12">
            <tr>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">Tanggal</th>
                <th style="border: 1px solid #000; padding: 5px;" rowspan="2">Kode Transaksi</th>
                <th style="border: 1px solid #000; padding: 5px;" colspan="3" style="text-align: center;">Masuk</th>
                <th style="border: 1px solid #000; padding: 5px;" colspan="3" style="text-align: center;">Keluar</th>
                <th style="border: 1px solid #000; padding: 5px;" colspan="3" style="text-align: center;">Sisa</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000; padding: 5px;">Qty</th>
                <th style="border: 1px solid #000; padding: 5px;">Harga</th>
                <th style="border: 1px solid #000; padding: 5px;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 5px;">Qty</th>
                <th style="border: 1px solid #000; padding: 5px;">Harga</th>
                <th style="border: 1px solid #000; padding: 5px;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 5px;">Qty</th>
                <th style="border: 1px solid #000; padding: 5px;">Harga</th>
                <th style="border: 1px solid #000; padding: 5px;">Jumlah</th>
            </tr>
            <?php
                $stokPlus = 0;
                $stokMin = 0;
                $sisaPlus = 0;
                $sisaMin = 0;
                $tkeluar = 0;
                foreach($laporan as $data){
                $stokPlus += $data->type == 'pembelian' ? $data->pembelian->jumlah : 0;
                $stokPlus += $data->type == 'awal' ? $data->saldo->jumlah : 0;
                $stokMin += $data->type == 'penjualan' ? $data->hpp->jumlah : 0;

                $sisaPlus += $data->type == 'pembelian' ? $data->saldo->jumlah * $data->saldo->harga : 0;
                $sisaPlus += $data->type == 'awal' ? $data->saldo->jumlah * $data->saldo->harga : 0;
                $sisaMin += $data->type == 'penjualan' ? $data->saldo->jumlah * $data->saldo->harga : 0;

                $tkeluar += $data->type == 'penjualan' ? $data->hpp->harga * $data->hpp->jumlah : 0;
            ?>
            <tr>
                <td style="border: 1px solid #000; padding: 5px;"><?=date('d M Y', strtotime($data->tgl))?></td>
                <td style="border: 1px solid #000; padding: 5px;"><?=$data->faktur?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->jumlah) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->harga) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->harga * $data->pembelian->jumlah) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->jumlah) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->harga) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->harga * $data->hpp->jumlah) : 0?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($data->saldo->jumlah)?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($data->saldo->harga)?></td>
                <td style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($data->saldo->jumlah * $data->saldo->harga)?></td>
            </tr>
            <?php } ?>
            <tr>
                <th style="border: 1px solid #000; padding: 5px;" colspan="7">Total</th>
                <th style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($tkeluar)?></th>
                <th style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($stokPlus-$stokMin)?></th>
                <th style="border: 1px solid #000; padding: 5px;" align="right"></th>
                <th style="border: 1px solid #000; padding: 5px;" align="right"><?=number_format($sisaPlus-$sisaMin)?></th>
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
