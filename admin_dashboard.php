	<?php
		include '../controllers/common.php';
		check_if_not_loggedIn();
		check_for_userType_admin();
		include '../includes/header.php';
		include '../includes/navbar.php';
		$sql = 'SELECT * FROM `users` WHERE userID = '.$_SESSION['userID'].'';
		$response = run_query($sql);
		$user = $response->fetch_assoc();
		$userName = $user['first_name'].' '.$user['last_name'];
	?>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #dddddd;
			  text-align: center;
			  padding: 6px;
			}

			tr:nth-child(even) {
			  background-color: #eee;
			}

		</style>
	<body data-spy="scroll" data-target="#navscrollspy" style="position: relative;" data-offset="50">
		<!-- Page Title -->
		<header class="page_header mb-0" id="headerhome" style="background-image: url('../assets/img/banner.jpg');background-size: cover;background-position: top;background-repeat: no-repeat;height: 350px;background-attachment: fixed;">
		  	<div class="overlay"></div>
			<div class="container">
			  <div class="row">
			    <div class="col-lg col-md mx-auto">
			      <div class="site-heading">
			        <h1>WELCOME BACK <b class="text-success" style="text-transform: uppercase;"><?= $user['first_name'] ?></b></h1>
			        <span class="subheading">Manage Everything from here...</span>
			        <div class="text-center">
						<img src="<?= $base_url.$user['image']?>" width="150" height="150" class="image-fluid" style="border-radius: 50%;border: 3px solid #101827;">
					</div>
			      </div>
			    </div>
			  </div>
			</div>
		</header>
		<!--End Page Title -->

		<div class="container-fluid m-0 p-0 mt-5 pt-5 sticky-top">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark m-0 p-1" id="navscrollspy">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			    <ul class="nav nav-pills navbar-nav mr-auto mt-2 mt-lg-0 custom-nav-text ml-1">
			      <li class="nav-item">
			        <a class="nav-link" href="#headerhome">Home </a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#user_list">User</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link " href="#product_list">Product</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#order_list">Order</a>
			      </li>
			      <li class="nav-item">
			        <a class="" href="<?=$base_url?>author/add_user.php">Add User</a>
			      </li>
			      <li class="nav-item">
			        <a class="" href="<?=$base_url?>products/add_product.php">Add Product</a>
			      </li>
			      <li class="nav-item">
			        <a class="" href="<?=$base_url?>author/update_user.php?id=<?= $_SESSION['userID']?>">Your Profile</a>
			      </li>
			    </ul>
			    <form method="post" action="" class="form-inline my-2 my-lg-0">
			      <input class="form-control mr-sm-2" type="search" name="data" placeholder="Search User" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
			    </form>
			  </div>
			</nav>
		</div>
		<div id="search_result">
			<?php
			if (isset($_POST['search']) && !empty($_POST['data'])) {?>
			 <h2 class="text-center pt-5 pb-3 text-danger">SEARCH RESULT</h2>
			<table class="table table-info table-striped table-hover">
				  <tr>
				    <th>SL</th>
				    <th>Full Name</th>
				    <th>Email</th>
				    <!-- <th>Contact</th> -->
				    <!-- <th>Address</th> -->
				    <th>User Type</th>
				    <th>Action</th>
				  </tr>
			 <?php
			 	$info = $_POST['data'];
			 	$sql = "SELECT * FROM `users` WHERE first_name like '%$info%' OR last_name like '%$info%' OR user_email like '%$info%'";
			 	$result = run_query($sql);
			 	if ($result->num_rows > 0) {
			 		
			 	$i = 1;
				 while ($row = $result->fetch_assoc()) {  ?> 
						  	<tr>
						    	<td><?= $i++ ?></td>
						    	<td><?=$row['first_name'].' '.$row['last_name'] ?></td>
						    	<td><?=$row['user_email']?></td>
						    	<!-- <td><?=$row['contact']?></td> -->
						    	<!-- <td><?=$row['address']?></td> -->
						    	<td><?=$row['user_type']?></td>
						    	<?php
						    	if ($row['user_type'] !== 'admin') {
						    		echo '
										<td><a href="delete_user.php?id='.$row['userID'].'">Delete</a><span> | </span>
						    				<a href="update_user.php?id='.$row['userID'].'">Update</a></td>
						    		';
							 	}
						    	if ($row['user_type'] == 'admin') {
						    		echo '<td class="text-muted">Restricted</td>';
						    			}?>
						    	</tr>
				<?php }

					}else{
						echo "
							<tr>
								<td colspan='9' class='text-warning bg-danger h3'><i>No User Found</i><td>
							<tr>
	
						";
					}

				 }
				 ?>
			</table>
		</div>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3">
				<!-- Option Start -->
				<div class="category pt-5" style="position: sticky;top: 0;z-index: 999;">
					<h4 class="bg-dark text-white text-center category-text">Manage Options</h4>
					<div class="row p-3">
						<div class="col-md-12 col-sm-2">
							<a href="#user_list">
								<button class="btn btn-lg CustomButton">Manage User</button>
							</a>
						</div>
						<div class="col-md-12 col-sm-2">
							<a href="#product_list">
								<button class="btn btn-lg CustomButton">Manage Product</button>
							</a>
						</div>
						<div class="col-md-12 col-sm-2">
							<a href="#order_list">
								<button class="btn btn-lg CustomButton">Manage Order</button>
							</a>
						</div>
						<div class="col-md-12 col-sm-2">
							<a href="<?=$base_url?>author/add_user.php">
								<button class="btn btn-lg CustomButton">Add User</button>
							</a>
						</div>
						<div class="col-md-12 col-sm-2">
							<a href="<?=$base_url?>products/add_product.php">
								<button class="btn btn-lg CustomButton">Add Product</button>
							</a>
						</div>
						<div class="col-md-12 col-sm-2">
							<a href="<?=$base_url?>author/update_user.php?id=<?= $_SESSION['userID']?>">
								<button class="btn btn-lg CustomButton">Manage Your Profile</button>
							</a>
						</div>
					</div>
				</div>
				<!-- Option End -->
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9">

				<section class="container-fluid pt-5 pb-2" id="user_list">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h2 class="bg-success p-2 text-white text-center">MANAGE USER LIST
								<button class="btn btn-success float-right" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
									<span class="fas fa-arrow-down"></span>
								</button>
							</h2>
							<table class="table-success table-striped table-hover">
							  <tr>
							    <!-- <th>ID</th> -->
							    <th>Full Name</th>
							    <th>Email</th>
							    <!-- <th>Contact</th> -->
							    <!-- <th>Address</th> -->
							    <th>User Type</th>
							    <th>Action</th>
							  </tr>
								
							  <?php
							  //output data of each row
							 	$sql = "SELECT * FROM `users`";
								$users = run_query($sql);
							  while ($row = $users->fetch_assoc()) { ?>
							  	<tr class="collapse show" id="collapse1">
							    	<!-- <td><?=$row['userID']?></td> -->
							    	<td><?=$row['first_name']?> <?=$row['last_name']?> </td>
							    	<td><?=$row['user_email']?></td>
							    	<!-- <td><?=$row['contact']?></td> -->
							    	<!-- <td><?=$row['address']?></td> -->
							    	<td><?=$row['user_type']?></td>

							    	<?php
							    	if ($row['user_type'] !== 'admin') {
							    		echo '
											<td><a href="delete_user.php?id='.$row['userID'].'">Delete</a><span> | </span>
							    				<a href="update_user.php?id='.$row['userID'].'">Update</a></td>
							    		';
								 	}
							    	if ($row['user_type'] == 'admin') {
							    		echo '<td class="text-muted">Restricted</td>';
							    			}?>
								</tr>
								<?php  }?>
							</table>
						</div>
					</div>
				</section>
				
				<hr class="bg-warning float-left" style="height: 5px;width: 50%;" /><hr class="bg-info float-right" style="height: 5px;width: 50%;" />
				
				<section class="container-fluid pt-5 pb-5" id="product_list">
				  <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2 class="bg-danger p-2 text-white text-center">MANAGE PRODUCT LIST
							<button class="btn btn-danger float-right" id="arrowUpDown" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
								<span class="fas fa-arrow-up" id="arrowUp"></span>
							</button>
						</h2>
						<table class="table-danger table-striped table-hover">
						  <tr>
						    <th>ID</th>
						    <th>Title</th>
						    <th>Price</th>
						    <th>Category</th>
						    <th>Added By [ID]</th>
						    <th>Action</th>
						  </tr>

						  <?php
						  //output data of each row
						 	$sql = "SELECT * FROM `products`";
							$products = run_query($sql);
						  while ($row = $products->fetch_assoc()) {
						  	$sql = "SELECT first_name , last_name FROM users WHERE userID = ".$row['userID']."";
						  	$response = run_query($sql);$user_info=$response->fetch_assoc();
						  	$added_by = $user_info['first_name'].' '.$user_info['last_name'];
						  	echo '<tr class="collapse show" id="collapse2">';
						    	echo '<td>'.$row['productID'].'</td>';
						    	echo '<td>'.$row['product_title'].'</td>';
						    	echo '<td>'.$row['product_price'].'</td>';
						    	echo '<td>'.$row['product_category'].'</td>';
						    	echo '<td>'.$added_by.' ['.$row['userID'].']'.'</td>';
						    	echo '<td><a href="'.$base_url.'products/remove.php?id='.$row['productID'].'">Delete</a><span> | </span>
						    				<a href="'.$base_url.'products/edit.php?id='.$row['productID'].'">Update</a></td>';
						    echo '</tr>';
						  }?>
						 </table>
						</div>
					</div>
				</section>
			
			<hr class="bg-warning" style="height: 5px;"/>

				<section class="container-fluid pt-5 pb-5" id="order_list">
				  <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2 class="bg-info p-2 text-white text-center">MANAGE ORDERS
							<button class="btn btn-info float-right" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3"><span class="fas fa-arrow-down"></span></button>
						</h2>
						<table class="table-info table-striped table-hover">
						  <tr>
						    <th>Order ID</th>
						    <th>Product ID</th>
						    <th>User ID</th>
						    <th>Order Date</th>
						    <th>Payment Status</th>
						    <th>Action</th>
						  </tr>

						  <?php
						  //output data of each row
						 	$sql = "SELECT * FROM `order` LIMIT 20";
							$res = run_query($sql);
						  while ($row = $res->fetch_assoc()) {
						  	echo '<tr class="collapse show" id="collapse3">';
						    	echo '<td>'.$row['orderID'].'</td>';
						    	echo '<td>'.$row['productID'].'</td>';
						    	echo '<td>'.$row['userID'].'</td>';
						    	echo '<td>'.$row['order_at'].'</td>';
						    	echo '<td>'.$row['payment_status'].'</td>';
						    	echo '<td><a href="'.$base_url.'products/remove_order.php?id='.$row['orderID'].'">Delete</a></td>';
						    echo '</tr>';
						  }?>
						 </table>
						</div>
					</div>
				</section>
			</div>
		</div>

	</body>
	<?php
	include '../includes/footer.php';
	?>
