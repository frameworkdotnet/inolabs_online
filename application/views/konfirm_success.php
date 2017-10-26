<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toko Online </title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php $no=0; foreach($invoices as $rbarang){
    
    ?>
		<p>Selamat <?php echo $rbarang->nama;?> , Pembelian Anda dengan ID Pesanan : <?php echo $rbarang->id_pesanan;?> telah DIKONFIRMASI, 
		silahkan tunggu persetujuan dari kami paling lambat 1x24 jam.</p>
	<?php }?>	
</html>