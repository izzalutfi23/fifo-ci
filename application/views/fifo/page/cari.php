<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Cari Barang</h3>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form action="<?=base_url('laporan/hasil')?>" method="post">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="pt-3">Pilih Barang</label>
									<select name="barang_id" class="form-control">
                                        <option value="">Pilih Barang</option>
                                        <?php 
                                            foreach($barang as $data){
                                        ?>
                                        <option value="<?=$data->id?>"><?=$data->nama?></option>
                                        <?php } ?>
                                    </select>
								</div>
								<div class="form-group col-md-6">
									<input type="submit" class="btn btn-primary form-control" style="margin-top: 37px;" value="Cari">
								</div>
							</div>
						</form>
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
