<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toko Online</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php $this->load->view('layout/top_menu') ?>
		
			<div class="col-md-10">
				<h3>Masukan ID Pesanan Anda</h3>
				<div><?= validation_errors() ?></div>
				<?= form_open_multipart('ctrack', ['class'=>'form-horizontal']) ?>
					
					  <div class="form-group">
						<label for="inputNama" class="col-sm-2 control-label">ID Pesanan :</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" name="id" placeholder="" value="<?= set_value('id') ?>">
						</div>
					  </div>
					  					  
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-primary">Check</button>
						</div>
					  </div>
					
				<?= form_close() ?>
			</div>
			
	</body>
</html>