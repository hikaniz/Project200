<?php
include '../controllers/common.php';
check_if_not_loggedIn();
if (isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] ) {	
			if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
					header('location:'.$GLOBALS['base_url'].'author/admin_dashboard.php');
				}else{
					date_default_timezone_set("Asia/Dhaka");
					$now = date('d-m-Y');

					$sql = 'INSERT INTO `order` (productID,userID,order_at,payment_status) VALUES ("'.$_GET['id'].'","'.$_SESSION['userID'].'","'.$now.'","Pending") ';
					$result = run_query($sql);
					header('location:'.$base_url.'author/user_dashboard.php'); 
				}
			  }
?>