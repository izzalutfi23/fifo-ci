<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper pb-0">
		<div class="page-header flex-wrap">
			<div class="header-left">
				<a href="<?=base_url('knn/uji')?>"><button class="btn btn-primary mb-2 mb-md-0 mr-2"> Data Uji
					</button></a>
			</div>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<div class="d-flex align-items-center">
					<a href="#">
						<p class="m-0 pr-3">BENY ANGGRIAWAN</p>
					</a>
					<a class="pl-3 mr-4" href="#">
						<p class="m-0">TI-A11.2017.10613</p>
					</a>
				</div>
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
					<i class="mdi mdi-plus-circle"></i> <a style="color: #FFF;"
						href="<?=base_url('knn/training')?>">Data Training</a> </button>
			</div>
		</div>
		<!-- chart row starts here -->
		<div class="row">
			<div class="col-sm-12 stretch-card grid-margin">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<div class="card-title"> Data Training <small class="d-block text-muted">Jumlah keseluruhan
									data training</small>
							</div>
						</div>
						<h3 class="font-weight-bold mb-0"> <?=$train?>
						</h3>
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
