	<?php
		include '../controllers/common.php';
		check_if_not_loggedIn();
		check_if_userType_visitor();
		include '../includes/header.php';
		include '../includes/navbar.php';

		$sql = 'SELECT * FROM `users` WHERE userID = '.$_SESSION['userID'].'';
		$response = run_query($sql);
		$user = $response->fetch_assoc();
		$userName = $user['first_name'].' '.$user['last_name'];
	?>

		<!-- Page Title -->
		<header class="page_header" style="background-image: url('../assets/img/banner.jpg');background-attachment: fixed;background-position: top;">
		  	<div class="overlay"></div>
			<div class="container">
			  <div class="row">
			    <div class="col-lg col-md mx-auto">
			      <div class="site-heading">
			        <h1>WELCOME BACK <b class="text-warning" style="text-transform: uppercase;"><?= $user['first_name'] ?></b></h1>
			        <span class="subheading">Your all activity will appear here..</span>
			        <div class="text-center">
						<img src="<?= $base_url.$user['image']?>" width="150" height="150" class="image-fluid" style="border-radius: 50%;border: 3px solid #101827;">
					</div>
			      </div>
			    </div>
			  </div>
			</div>
		</header>

		<!--End Page Title -->
		
		<section class="mb-5 p-2">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="container">
						<div class="card text-center pt-5 mt-5 p-3 bg-secondary text-white">
							<div class="card-image text-center">
								<img src="<?= $base_url.$user['image']?>" width="150" height="150" class="image-fluid" style="border-radius: 50%;border: 2px solid #fff;">
							</div>
							<div class="card-title mt-3">
								<h3 class="title"><?= $userName ?></h3>
								<strong><?= $user['user_email']?></strong>
							</div><hr class="m-0 p-0 bg-info" />
							<div class="bio mt-2 text-left">
								<p>User Type : <b style="text-transform: uppercase;"><?= $user['user_type']?></b></p>
								<p>Date of Birth: <?= $user['birth_date']?></p>
								<p>Contact : +<?= $user['contact']?> </p>
								<p>Address : <?= $user['address']?> </p>
							</div>
							<a href='<?=$base_url?>author/update_user.php' class="btn btn-sm btn-outline-light">Update Profile</a>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<div class="home_post">
						<h2 class="bg-black text-white text-center">Your Ordered Product :</h2>
						<ul class="row p-2">
							<?php
								$totall = 0 ;
								$sql = 'SELECT * FROM `order` WHERE userID = '.$_SESSION['userID'].'';
								$response = run_query($sql);
							
								while ($result = $response->fetch_assoc()) { 
									$query = 'SELECT * FROM `products` WHERE productID = '.$result['productID'].'';
									$res = run_query($query);
									$row = $res->fetch_assoc();
									$totall +=  $row['product_price'];
							?>
							<li class="col-md-6 col-sm-6 bg-white mt-2 mb-2">
							  <div class="row">
								<div class="col-md-5">
					        		<div class="thumbnail pt-2">
					        			<figure>
					        				<img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100">
					        			</figure>
					        		</div>
								</div>
								<div class="col-md-7 pt-2">
									<h5 class="m-0"><?= $row['product_title']?> </h5>
									<p><?= $row['product_category']?> </p>
									<div>
										<p class="m-0">Price : $<?= $row['product_price']?> </p>
										<p class="m-0">Order Date : <?= $result['order_at']?> </p>
										<p class="m-0">Order ID : <?= $result['orderID']?> </p>
										<p> Payment Status: <?= $result['payment_status']?> </p>
									</div>
									<a href="<?=$base_url?>products/remove_order.php?id=<?=$result['orderID']?>" class="btn btn-sm btn-outline-danger float-right mb-2">REMOVE</a>
								</div>
							  </div>
							</li>	
							<?php } ?>
						  </ul>
						</div>
						<hr class="bg-dark" /><hr class="bg-dark" />
						<h2 class="bg-info text-white float-right p-2">Totall Amount : $<?= $totall ?> </h2>
					</div>
				</div>
		</section>

	<?php
	include '../includes/footer.php';
	?>
