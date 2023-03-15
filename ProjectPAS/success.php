<?php 
	include"Koneksi/config.php";
	include"layout/header.php"; 
	
	
?> 	 
		<div class="col-md-9">
		
			<div class="alert alert-success">Transaksi Berhasil. Silahkan tunggu. Admin akan segera menghubungi anda.</div>
			<div class="row">
			<div class="col-md-12">
				<hr>
				<h4>
                   Detail Pesanan yang anda beli:
                </h4>				
				<table class="table table-striped table-hove"> 
		<thead> 
				<tr> 
					<th>#</th> 
					<th>Nama Produk</th> 
					<th>Harga Satuan</th> 
					<th>QTY</th> 
					<th>Harga *</th>   
				</tr> 
			</thead> 
			<tbody> 
		 <?php
			$pes = mysql_fetch_array(mysql_query("SELECT * FROM pesanan WHERE user_id='$_SESSION[iam_user]' ORDER BY id DESC LIMIT 1"));
			$q = mysql_query("SELECT * FROM detail_pesanan WHERE pesanan_id='$pes[id]'");
			$ongkir = $pes['ongkir'];
			$total = 0;
		 while($data=mysql_fetch_object($q)){ ?> 
				<tr> 
					<th scope="row"><?php echo $no++; ?></th> 
					<?php
						$katpro = mysql_query("select*from produk where id='$data->produk_id'");
								$p = mysql_fetch_object($katpro);
					?>
					<td><?php echo $p->nama ?></td> 
					<td><?php echo number_format($p->harga, 2, ',', '.')  ?></td>  
					<td><?php echo $data->qty ?></td>
					<?php $t = $data->qty*$p->harga; 
						$total += $t;
					?>
					<td><?php echo number_format($t, 2, ',', '.')  ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan="4" class="text-center">
					<h5><b>ONGKIR</b></h5>
					</td>
					<td class="text-bold">
					<h5><b><?php  echo number_format($pes['ongkir'], 2, ',', '.') ?></b></h5>
					</td>				
				</tr>
				<tr>
					<td colspan="4" class="text-center">
					<h5><b>TOTAL HARGA</b></h5>
					</td>
					<td class="text-bold">
					<h5><b><?php  echo number_format($total+$ongkir, 2, ',', '.') ?></b></h5>
					</td>
				</tr>
			</tbody> 
		</table>
			
			</div> 
			
			</div> 
		</div> 	
<?php include"layout/footer.php"; ?>