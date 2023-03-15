<?php 
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_select_db("pemesanan_baju");
	
	// settings URL
	$url = "http://localhost/ProjectWebPAS/";
	$title = "Website Pemesanan Baju";
	$no = 1;
	
	function alert($command){
		echo "<script>alert('".$command."');</script>";
	}
	function redir($command){
		echo "<script>document.location='".$command."';</script>";
	}
	function validate_admin_not_login($command){
		if(empty($_SESSION['iam_admin'])){
			redir($command);
		}
	}
?>