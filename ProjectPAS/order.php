<?php
	include"Koneksi/config.php";
	include"layout/header.php";
		
	 if(empty($_POST['okay'])){
		 redir("keranjang.php");
	 }
	 $user= mysql_query("SELECT*FROM user");
?>
		<div class="col-md-9">
		<?php
			if(isset($_POST['order'])){
				$tanggal_pesan = $_POST['tanggal_pesan'];
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
					$q = "INSERT INTO pesanan VALUES(NULL,'$tanggal_pesan','$tanggal_digunakan','1','$nama','$alamat','$kt->nama','$kt->ongkir','$telephone','0','Belum Diabayar')";
					$input = mysql_query($q);
					if($input){
					redir("keranjang.php");}
			}		
		?>
			<div class="row">
			<div class="col-md-7">
				<h4>
                   Pengisian Data Pembeli :
                </h4>
				<hr>
				 <form action="" method="post" enctype="multipart/form-data">

						<label>Waktu Pengiriman</label><br>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker'>
						<input type='text' class="form-control" name="tanggal_digunakan">
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
							</div>
						</div>
						<label>Nama</label><br>
						<input type="text" class="form-control" name="nama" value=""><br>
						<label>Telephone (HP)</label><br>
						<input type="text" class="form-control" name="telephone" value="" ><br>
						<label>Alamat Pengiriman</label><br>
						<input type="text" class="form-control" name="alamat" value=""><br>
						<select name="kota" required class="form-control">
							<?php
								$kota = mysql_query("select*from kota");
								while($kp = mysql_fetch_array($kota)){
							?>
							<option value="<?php echo $kp['id']; ?>"><?php echo $kp['nama'] ?> - <?php echo "Rp ".number_format($kp['ongkir'], 2, ',', '.'); ?></option>
								<?php } ?>
						</select><br>
						<input type="submit" name="order" value="Kirim" class="btn btn-success">
					</form>
			</div>
			<div class="col-md-12">
				<hr>
				<h4>
                   Detail Pesanan :
                </h4>
				<table class="table table-striped" style="width:100%">
				<thead>
				<tr style="background:#c3ebf8;font-weight:bold;">
					<td style="width:15%"> Produk </td>
					<td style="width:40%">Details</td>
					<td style="width:10%">QTY</td>
					<td style="width:15%">Total</td>
				</tr>
				</thead>
				<tbody>
<?php
$total = 0;
$cart = unserialize($_SESSION['cart']);
if($cart == ''){
    $cart = [];
}
foreach($cart as $id => $qty){
     $product = mysql_fetch_array(mysql_query("select * from produk WHERE id='$id'"));
	if(!empty($product)){
		$t = $qty * $product['harga'];
		$total += $t;
		?>
				<tr class="barang-shop">
					<td class="CartProductThumb"><div> <a href="<?php echo $url; ?>menu.php?id=<?php echo $product['id'] ?>"><img src="<?php echo $url.'uploads/'.$product['gambar']; ?>" alt="img" width="120px"></a> </div></td>
					<td><div class="CartDescription">
					<h4> <a href="<?php echo $url; ?>menu.php?id=<?php echo $product['id'] ?>"><?= $product['nama'] ?></a> </h4>
					<div class="price"><?php echo  "Rp ".number_format($product['harga'], 2, ',', '.') ?></div>
					</div></td>
					<td>
						<?php echo $qty ?> pcs
					</td>
					<td class="price"><?php echo number_format($t, 2, ',', '.') ?></td>

				</tr>
<?php } } ?>
				<tr style="background:#c3ebf8;font-weight:bold;">
					<td colspan="3">TOTAL</td>
                    <td><?php echo number_format($total, 2, ',', '.') ?></td>
				</tr>
				</tbody>
				</table>
			</div>
			</div>
		</div>
		<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>
<?php include"layout/footer.php"; ?>
