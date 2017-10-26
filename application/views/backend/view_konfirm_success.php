<!DOCTYPE html>
<html>
<head>
  <title>Detail Transaksi</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <style>
   
  
  </style>
</head>
<body>
<?php $this->load->view('backend/admin_menu') ?>
<h1><p>Detail Transaksi</p></h1>
<hr></hr>
<table width="50px" class="table table-striped table-hover">

    <?php $no=0; foreach($qbarang as $rbarang){
    
    ?>
    
	<tr>
		<td width="140">ID Pesanan</td>
		<td width="3">:</td>
		<td><?php echo $rbarang->id_pesanan;?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $rbarang->nama;?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $rbarang->alamat;?></td>
	</tr>
	<tr>
		<td>No. HP/Telp</td>
		<td>:</td>
		<td><?php echo $rbarang->telp;?></td>
	</tr>
	<tr>
		<td>Email :</td>
		<td>:</td>
		<td><?php echo $rbarang->email;?></td>
	</tr>
	<tr>
		<td>Tanggal Pesan</td>
		<td>:</td>
		<td><?php echo $rbarang->due_date;?></td>
	</tr>
	<tr>
		<td>Status Pesanan</td>
		<td>:</td>
		<td><?php echo $rbarang->status;?></td>
	</tr>
	<tr>
		<td>Total Pembayaran</td>
		<td>:</td>
		<td><?php echo "Rp. ".number_format($rbarang->total,0,',','.');?></td>
	</tr>
    <?php }?>
</table>

</body>
</html>