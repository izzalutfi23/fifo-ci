<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Detail Barang Masuk</h3>
            <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<a href="<?= base_url('pembelian/pdf/'.$this->uri->segment(3)) ?>" target="_blank" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text mr-2">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Detail Barang Masuk</h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Faktur</th>
                                        <th>Kode Suplier</th>
                                        <th>Suplier</th>
                                        <th>Tgl Pemesanan</th>
                                        <th>Kode Barang</th>
                                        <th>Retur</th>
										<th>Nama Barang</th>
										<th>Jumlah</th>
										<th>C2</th>
										<th>Harga Satuan</th>
                                        <th>Total</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($detail as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->faktur?></td>
                                        <td><?=$suplier->kode?></td>
                                        <td><?=$suplier->nama?></td>
                                        <td><?=date('d M Y', strtotime($pembelian->tgl))?></td>
										<td><?=$data->kode_barang?></td>
                                        <td><?=$data->retur?></td>
                                        <td><?=$data->nama?></td>
                                        <td><?=$data->jumlah?></td>
										<td><?=$data->c2?></td>
										<td><?=number_format($data->harga)?></td>
                                        <td><?=number_format($data->harga*($data->jumlah*$data->c2))?></td>
                                        <td align="center">
                                            <?php 
                                                if($data->status == '0'){
                                            ?>
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".tambah<?=$data->id?>">Edit</button>
                                            <?php 
                                                }else{
                                            ?>
                                            <button class="btn btn-success"><i class="fa fa-check"></i></button>
                                            <?php } ?>
                                        </td>
									</tr>
                                    <!-- Modal -->
                                    <div class="modal fade tambah<?=$data->id?>" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fade">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Barang Masuk</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?=base_url('pembelian/store')?>" method="post">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label class="pt-3">Produk</label>
                                                                <input type="hidden" name="barang_id" value="<?=$data->barang_id?>">
                                                                <input type="hidden" name="faktur" value="<?=$data->faktur?>">
                                                                <input type="hidden" name="tgl" value="<?=$pembelian->tgl?>">
                                                                <input type="hidden" name="pembelian_id" value="<?=$pembelian->id?>">
                                                                <input type="hidden" name="id" value="<?=$data->id?>">
                                                                <input type="text" class="form-control" name="" value="<?=$data->nama?>" readonly="readonly">
                                                                <label class="pt-3">Jumlah (Qty)</label>
                                                                <input required="required" type="number" name="jumlah" class="form-control" value="<?=$data->jumlah?>">
                                                                <label class="pt-3">Harga Per Unit (Satuan)</label>
                                                                <input required="required" type="harga" name="harga" class="form-control" value="<?=$data->harga?>">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal End -->
									<?php } ?>
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
