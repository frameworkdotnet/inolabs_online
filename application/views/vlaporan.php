<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title>
  <style>
  table{
      border-collapse: collapse;
      width: 70%;
      margin: 0 auto;
  }
  table th{
      border:1px solid #000;
      padding: 3px;
      font-weight: bold;
      text-align: center;
  }
  table td{
      border:1px solid #000;
      padding: 3px;
      vertical-align: top;
  }
 
  </style>
</head>
 
<body>
<p style="text-align: center">Tabel Barang</p>
<table>
    <tr>
        <th>No</th>
        <th style="width: 20%">Nama Barang</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Satuan</th>

    </tr>
    <?php $no=0; foreach($qbarang as $rbarang){
    $no++;
    ?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $rbarang->id_pesanan;?></td>
        <td><?php echo $rbarang->email;?></td>
        <td><?php echo $rbarang->due_date;?></td>
        <td><?php echo $rbarang->status;?></td>
        <td><?php echo $rbarang->total;?></td>
    </tr>
    <?php }?>
</table>
<p style="text-align: center"><a href="<?php echo base_url()?>index.php/claporanpdf/cetakpdf">Cetak PDF</a>   </p>
 
</body>
</html>