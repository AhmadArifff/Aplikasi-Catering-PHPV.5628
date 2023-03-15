<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title><?php echo $title; ?></title>
    <link href="<?php echo $url ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/bootstrap/css/datetimepicker.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/full-slider.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet">
  <body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-blue">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          </button>
          <a class="navbar-brand" href="index.php">Web Pemesanan Baju</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse"> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $url ?>">Home</a></li>
            <li><a href="<?php echo $url ?>menu.php">Menu Katering</a></li> 
            <?php if(!empty($_SESSION['iam_user'])){ ?>
			<?php 
				$user = mysql_fetch_object(mysql_query("SELECT*FROM user where id='$_SESSION[iam_user]'"));
			?>
      <li><a href="<?php echo $url ?>pembayaran.php">Pembayaran</a></li>      
			<li class="dropdown">
				
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi <?php echo $user->nama; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>profile.php">Profil</a></li> 
                <li><a href="<?php echo $url ?>logout.php">Logout</a></li>  
              </ul>
            </li>
			<?php }else{ ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login/Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>login.php">Login</a></li> 
                <li><a href="<?php echo $url ?>register.php">Register</a></li>  
              </ul>
            </li>
			<?php } ?>
			

          </ul>
      </div>
    </nav>

   <?php if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] == $url.'index.php'){ ?>
    <div class="container">
    <header id="myCarousel" class="carousel slide">\
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li> 
        </ol>
          <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/bar.png');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/welcome.png');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div> 
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
   <?php } ?>
	
	<div class="container" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-3">
			<div style="background:#5bc0de; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px;">
			<h4>Kategori Menu</h4>
			</div>
			<ul class="kategori">
				<?php 
					$kategori = mysql_query("SELECT * FROM kategori_produk"); 
					while($data = mysql_fetch_array($kategori)){
				?>
					<li><a href="<?php echo $url; ?>menu.php?kategori=<?php echo $data['id'] ?>"><?php echo $data['nama']; ?> (
					<?php 
						$ck = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE kategori_produk_id='$data[id]'"));
						if($ck > 0){ echo $ck; }else{ echo 0; } ?>
					)</a></li>
				<?php } ?>
			</ul>
			<div style="background:#5bc0de; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px;">
				<h4>Keranjang Belanja</h4>
			</div>
			<div style=" width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px; border: 1px dashed #000;">
			
			<?php
                            if(isset($_SESSION['cart'])){
                                $total = 0;
                                $cart = unserialize($_SESSION['cart']);
                                if($cart == ''){
                                    $cart = [];
                                }
                                foreach($cart as $id => $qty){
                                    $product = mysql_fetch_array(mysql_query("select * from produk WHERE id='$id'"));
                                    if(isset($product)){
                                       $t = $qty * $product['harga'];
                                       $total += $t;
                                    }
                                }
                                echo '<h4 style="color:#f00;">Rp '. number_format($total, 2, ',', '.') .'</h4>';
                            }else{
                                echo '<h4 style="color:#f00;">Rp 0,00</h4>';
                            }
                                
                        ?>
				
				<a href="<?php echo $url; ?>keranjang.php">Lihat Detail</a>
			</div>
			<div class="row col-md-12">
					
			</div>
			<div class="row col-md-12">
				<hr>
				<img src="<?php echo $url.'assets/img/bar.png'; ?>" width="100%"><br><br>
				<img src="<?php echo $url.'assets/img/welcome.png'; ?>" width="100%">
			</div>
		</div>