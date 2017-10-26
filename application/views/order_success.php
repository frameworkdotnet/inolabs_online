<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toko Online </title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		
			<hr>
		<p>Pilih Metode Pembayaran berikut ini :</p><br>	
		<?php foreach ($invoices as $u){ ?>
		
		<a href="<?php echo base_url().'index.php/produkcoba/buy/'.$u->id; }?>">
		<img src="<?php echo base_url(); ?>assets/images/paypal.png" style="width: 170px;"></a>
		
		<a href="<?php echo base_url().'index.php/konfirmasi/'?>">
		<img src="<?php echo base_url(); ?>assets/images/logo-bank.png" style="width: 170px;"></a>
		
		<p>Thank you, your order is being processed..</p>
		
</html>