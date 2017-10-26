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
		
		
		
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Product</th>
					<th>Jumlah</th>
					<th>Price</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i=0;
					foreach ($this->cart->contents() as $items) : 
					$i++;
				?>
				<tr>
					<td><?= $i ?></td>
					<td><?= $items['name'] ?></td>
					<td><?= $items['qty'] ?></td>
					<td align="right"><?= number_format($items['price'],0,',','.') ?></td>
					<td align="right"><?= number_format($items['subtotal'],0,',','.') ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td align="right" colspan="4">Total </td>
					<td align="right"><?= number_format($this->cart->total(),0,',','.'); ?></td>
				</tr>
				<tr>
					<td align="right" colspan="4"><?= anchor('welcome/clear_cart','Clear Cart',['class'=>'btn btn-danger']) ?>
					<?= anchor(base_url(),'Continue Shopping',['class'=>'btn btn-primary']) ?> </td>
			</tr>
			</tfoot>
		</table>
		<div align="right">
			 
			</div>
			
			
			<div class="col-md-10">
				<h3>Masukan data pengiriman</h3>
				<div><?= validation_errors() ?></div>
				<?= form_open_multipart('order', ['class'=>'form-horizontal']) ?>
					
					  <div class="form-group">
						<label for="inputNama" class="col-sm-2 control-label">Nama :</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" name="nama" placeholder="" value="<?= set_value('nama') ?>">
						</div>
					  </div>
					  
					  <div class="form-group">
						<label for="inputAlamat" class="col-sm-2 control-label">Alamat :</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" name="alamat" placeholder="" value="<?= set_value('alamat') ?>">
						</div>
					  </div>
					  
					  <div class="form-group">
						<label for="inputTelp" class="col-sm-2 control-label">No Handphone/Telp :</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" name="telp" placeholder="" value="<?= set_value('telp') ?>">
						</div>
					  </div>
					  
					  <div class="form-group">
						<label for="inputEmail" class="col-sm-2 control-label">Email :</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" name="email" placeholder="" value="<?= set_value('email') ?>">
						</div>
					  </div>
					  
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-primary">Simpan & Checkout</button>
						</div>
					  </div>
					
				<?= form_close() ?>
			</div>
			
	</body>
</html>