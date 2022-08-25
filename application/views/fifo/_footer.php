</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?=base_url()?>assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?=base_url()?>assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<script src="<?=base_url()?>assets/vendors/chart.js/Chart.min.js"></script>
<script src="<?=base_url()?>assets/vendors/flot/jquery.flot.js"></script>
<script src="<?=base_url()?>assets/vendors/flot/jquery.flot.resize.js"></script>
<script src="<?=base_url()?>assets/vendors/flot/jquery.flot.categories.js"></script>
<script src="<?=base_url()?>assets/vendors/flot/jquery.flot.fillbetween.js"></script>
<script src="<?=base_url()?>assets/vendors/flot/jquery.flot.stack.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?=base_url()?>assets/js/off-canvas.js"></script>
<script src="<?=base_url()?>assets/js/hoverable-collapse.js"></script>
<script src="<?=base_url()?>assets/js/misc.js"></script>
<script src="<?=base_url()?>assets/js/settings.js"></script>
<script src="<?=base_url()?>assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?=base_url()?>assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
<!-- Datatable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
	$(document).ready(function () {
		$('#example').DataTable({
			// dom: 'Bfrtip',
			// buttons: [
			// 	'print', 'pdf', 'csv', 'excel'
			// ]
		});
	});

	function autofill(){
        var barcode = document.getElementById('barcode').value;
        $.ajax({
			url:"<?= base_url('produk/cari') ?>",
			data:'&barcode='+barcode,
			success:function(data){
				var hasil = JSON.parse(data);  
						
				$.each(hasil, function(key,val){      
					document.getElementById('barcode').value=val.barcode;
					document.getElementById('barang_id').value=val.id;
					document.getElementById('nama').value=val.nama;
					document.getElementById('retur').value=val.retur;
					document.getElementById('c2').value=val.c2;
				});
            }
        });             
    }

	function autofill2(id){
        var barcode = document.getElementById('barcode').value;
        $.ajax({
			url:"<?= base_url('produk/cari2/') ?>"+id,
			data:'&barcode='+barcode,
			success:function(data){
				var hasil = JSON.parse(data);  
						
				$.each(hasil, function(key,val){      
					document.getElementById('barcode').value=val.barcode;
					document.getElementById('barang_id').value=val.id;
					document.getElementById('nama').value=val.nama;
					document.getElementById('retur').value=val.retur;
					document.getElementById('c2').value=val.c2;
				});
            }
        });             
    }

</script>
</body>

</html>
