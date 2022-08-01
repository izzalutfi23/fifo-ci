<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Laporan Stok Barang</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<a href="<?=base_url('laporan/pdf/'.$barang->id)?>" target="_blank">
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Buku Stok <?=$barang->nama?></h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th rowspan="2">Tanggal</th>
										<th rowspan="2">Kode Transaksi</th>
										<th colspan="3" style="text-align: center;">Masuk</th>
										<th colspan="3" style="text-align: center;">Keluar</th>
										<th colspan="3" style="text-align: center;">Sisa</th>
									</tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Qty</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Qty</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                    </tr>
								</thead>
								<tbody>
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
                                        <td><?=date('d M Y', strtotime($data->tgl))?></td>
                                        <td><?=$data->faktur?></td>
                                        <td align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->jumlah) : 0?></td>
                                        <td align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->harga) : 0?></td>
                                        <td align="right"><?=$data->type == 'pembelian' ? number_format($data->pembelian->harga * $data->pembelian->jumlah) : 0?></td>
                                        <td align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->jumlah) : 0?></td>
                                        <td align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->harga) : 0?></td>
                                        <td align="right"><?=$data->type == 'penjualan' ? number_format($data->hpp->harga * $data->hpp->jumlah) : 0?></td>
                                        <td align="right"><?=number_format($data->saldo->jumlah)?></td>
                                        <td align="right"><?=number_format($data->saldo->harga)?></td>
                                        <td align="right"><?=number_format($data->saldo->jumlah * $data->saldo->harga)?></td>
                                    </tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">Total</td>
										<td align="right"><?=number_format($tkeluar)?></td>
										<td align="right"><?=number_format($stokPlus-$stokMin)?></td>
										<td align="right"></td>
										<td align="right"><?=number_format($sisaPlus-$sisaMin)?></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->

	<!-- partial:partials/_footer.html -->
	<footer class="footer">
		<div class="d-sm-flex justify-content-center justify-content-sm-between">
			<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
			BENY ANGGRIAWAN 2022</span>
			<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
					href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a>
				from Bootstrapdash.com</span>
		</div>
	</footer>
	<!-- partial -->
</div>
<!-- main-panel ends -->
