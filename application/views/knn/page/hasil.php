<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Hasil Uji KNN</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=base_url('home/uji')?>">Uji</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add </li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Uji KNN</h4>
						<p class="card-description">Nilai hasil inputan form uji</p>
						<form action="<?=base_url('home/uji_action')?>" method="post">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="pt-3">Kill</label>
									<input type="number" name="kill" class="form-control" value="<?= $input['kill'] ?>">
									<label class="pt-3">Assist</label>
									<input type="number" name="assist" class="form-control" value="<?= $input['assist'] ?>">
									<label class="pt-3">K/D</label>
									<input type="text" name="kd" class="form-control" value="<?= $input['kd'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label class="pt-3">Senjata</label>
									<select name="senjata" class="form-control">
										<option <?php $input['senjata'] == "M416" ? 'selected' : '' ?> value="M416">M416</option>
										<option <?php $input['senjata'] == "AKM" ? 'selected' : '' ?> value="AKM">AKM</option>
										<option <?php $input['senjata'] == "UMP" ? 'selected' : '' ?> value="UMP">UMP</option>
										<option <?php $input['senjata'] == "SCARL" ? 'selected' : '' ?> value="SCARL">SCARL</option>
									</select>
									<label class="pt-3">Score</label>
									<input type="number" name="score" class="form-control" placeholder="<?= $input['score'] ?>">
									<label class="pt-3">K</label>
									<input type="number" name="k" class="form-control" placeholder="<?= $input['k'] ?>">
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-6">
								<pre>
									<?php print_r($results); ?>
                                </pre>
							</div>
							<div class="col-md-6">
								<label>Hasil akhir yang didapat?</label><br>
								<b><u><?= $hasil ?></u></b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
	<!-- partial:../../partials/_footer.html -->
	<footer class="footer">
		<div class="d-sm-flex justify-content-center justify-content-sm-between">
			<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
			BENY ANGGRIAWAN
				2022</span>
			<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
					href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a>
				from
				Bootstrapdash.com</span>
		</div>
	</footer>
	<!-- partial -->
</div>
<!-- main-panel ends -->
