<?php
include '../controllers/common.php';
check_if_not_loggedIn();

$sql = 'DELETE FROM `order` WHERE orderID = '.$_GET['id'].'';
$result = run_query($sql);

if ($_SESSION['user_type'] == 'visitor') {
		header('location:'.$base_url.'author/user_dashboard.php'); 
}elseif ($_SESSION['user_type'] == 'admin' ) {
	header('location:'.$base_url.'author/admin_dashboard.php#order_list');
}

?>