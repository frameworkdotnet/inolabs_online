<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <?=anchor(base_url(), 'Toko Online', ['class'=>'navbar-brand'])?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      	  
	<?php  ?>
      <ul class="nav navbar-nav navbar-left">
        <li><?=anchor('admin/products','Products')?></li>
        <li><?=anchor('admin/invoices','Invoices')?></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
			<span style="line-height:50px;">
				
			</span>
		</li>
		<li>
			<?php echo anchor('welcome', 'Logout');?>
		</li>
      </ul>
	  <?php  ?>
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
