<?php
include '../controllers/common.php';
check_if_not_loggedIn();
check_for_userType_admin();

$sql = 'DELETE FROM `products` WHERE productID = '.$_GET['id'].'';
$result = run_query($sql);

if ($_SESSION['user_type'] == 'admin' ) {
	header('location:'.$base_url.'author/admin_dashboard.php#product_list');
}

?>