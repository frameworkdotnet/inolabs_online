<!doctype html>
<html>
	<head>
		<title>Admin Page | View All Invoices</title>
		<!-- Load JQuery dari CDN -->
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		
		<!-- Load DataTables dan Bootstrap dari CDN -->
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
	</head>
	<body>
		<?php $this->load->view('backend/admin_menu')?>
		<!-- dalam div row harus ada col yang maksimum nilainya 12 -->
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			
				<table id="myTable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Invoice ID</th>
                            <th>Nama</th>
                            <th>Email</th>
							<th>Alamat</th>
							<th>Nomor HP/Telp</th>
							<th>Tanggal Pesan</th>
							<th>Tanggal Expired</th>
							<th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($invoices as $invoice) : ?>
						<tr>
							<td><?=$invoice->id_pesanan?></td>
							<td><?=$invoice->nama?></td>
							<td><?=$invoice->email?></td>
							<td><?=$invoice->alamat?></td>
							<td><?=$invoice->telp?></td>
							<td><?=$invoice->tgl_pesan?></td>
							<td><?=$invoice->due_date?></td>
							<td><?=$invoice->total?></td>
							<td><?=$invoice->status?></td>
                            <td>
                                <?=anchor(	'admin/invoices/detail/' . $invoice->id, 
											'Details',
											['class'=>'btn btn-default btn-sm'])
								?>
								<?=anchor(	'admin/invoices/admin_reject/' . $invoice->id, 
											'Reject',
											['class'=>'btn btn-danger btn-sm']);
								?>
								
								<?php $tgl = date('y-m-d H:i:s');
										$tgl1 = $invoice->due_date;
										
								if ($invoice->status == 'confirmed'){
									echo anchor(	'admin/invoices/admin_konfirm/' . $invoice->id, 
											'Konfirmasi',
											['class'=>'btn btn-danger btn-sm']);
								} /*if ($invoice->due_date <= date('y-m-d H:i:s')){
									echo anchor(	'admin/invoices/admin_reject/' . $invoice->id, 
											'Reject',
											['class'=>'btn btn-danger btn-sm']);
								}*/else{
								}
								?>
                            </td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		
		<script>
			$(document).ready(function(){
				$('#myTable').DataTable();
			});
		</script>
	</body>
</html>
