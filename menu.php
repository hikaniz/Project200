	<?php
		include '../controllers/common.php';
		include '../includes/header.php';
		include '../includes/navbar.php';
	?>
<body data-spy="scroll" data-target="#navscrollspy" style="position: relative;" data-offset="50">

		<!-- Page Title -->
		<header class="page_header mb-0" style="background-image: url('../assets/img/banner.jpg')">
		  	<div class="overlay"></div>
			<div class="container">
			  <div class="row">
			    <div class="col-lg col-md mx-auto">
			      <div class="site-heading">
			        <h5>WELCOME TO</h5>
			        <h1 class="display-3">COFFEE CLUB</h1>
			        <span class="subheading">Chose your favourite Food Item and order them online.</span>
			      </div>
			    </div>
			  </div>
			</div>
		</header>
		<!--End Page Title -->

		<section class="gray-bg" id="searchResult">
			<div class="container pt-5">
				 <form method="post" action="<?=$base_url?>products/menu.php#searchResult" class="form-inline my-2 my-lg-0 justify-content-center">
			      <input class="form-control bg-dark text-warning" type="search" name="searchItem" placeholder="SEARCH Item here" aria-label="Search" style="width: 60%;height: 50px;">
			      <button class="btn btn-lg btn-dark my-2 my-sm-0" type="submit" name="search">Search</button>
			    </form>
			</div>
		<?php
		if (isset($_POST['search']) && !empty($_POST['searchItem'])) {
		          		$itemName = $_POST['searchItem'];
		          		$sql = "SELECT * FROM `products` WHERE product_title like '%$itemName%' OR product_category like '%$itemName%'";
		          		$result = run_query($sql);
		?>
			<div class="home_post_container">   
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content pt-5">
	                	<h2> <span>SEARCH RESULT</span> </h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         
		          <ul class="row bg-secondary">
		          	<?php
		         if ($result->num_rows>0) {
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}
		        		}else{
		        	echo "<li class='text-center w-100'><p class='text-warning p-5 h3'><i>No Item found with <strong class='text-white'> ".$itemName."</strong> </i></p></li>";
		        	}?>
		           </ul>
			    </div>
			 </div>
			<?php	}?>
		</section>

		 <!--TOP SELLERS SECTION START-->
        <section class="gray-bg kode-best-seller-sec mb-5">
        	<div class="container">
            	<!--SECTION CONTENT START-->
            	<div class="section-content">
                	<h2>Best <span>Top Rated</span> Item on COFFEE CLUB</h2>
                    <p>So many convenient ways to get your festive favorites.</p>
                </div>
                <!--SECTION CONTENT END-->
                <ul class="row">
                	<?php
		          	$sql = 'SELECT * FROM `products` LIMIT 4 ';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
                	<!--PRODUCT GRID START-->
                	<li class="col-md-3">
                    	<div class="best-seller-pro">
                        	<figure>
                            	<img src="<?= $base_url.$row['product_image']?>" height="280" alt="product thumbnail">
                            </figure>
                            <div class="kode-text">
                            	<h3><?= $row['product_title']?></h3>
                            </div>
                            <div class="kode-caption">
                            	<h3><?= $row['product_title']?></h3>
                                <div class="rating">
									<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
								</div>
                                <p><?= $row['product_category']?></p>
                                <p class="price">$<?= $row['product_price']?></p>
                                <a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="add-to-cart">Add To Cart</a>
                            </div>
                        </div>
                    </li>
                    <!--PRODUCT GRID END-->
                    <?php } ?>
				</ul>	
            </div>
        </section>
        <!--TOP SELLERS SECTION END-->


		

	<!-- MENU STORE START-->
	<div class="row">
		<div class="container-fluid m-0 p-0 sticky-top">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark m-0 p-1" id="navscrollspy">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			    <ul class="nav nav-pills navbar-nav mr-auto mt-2 mt-lg-0 custom-nav-text ml-1">
			      <li class="nav-item">
			        <a class="nav-link" href="#Hot_Coffees">Hot Coffees</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Hot_Teas">Hot Teas</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link " href="#Hot_Drinks">Hot Drinks</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Coffee_Frappuccino">Coffee Frappuccino</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Cold_Coffees">Cold Coffees</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Iced_Teas">Iced Teas</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Cold_Drinks">Cold Drinks</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#Home_Coffee">Home_Coffee</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		</div>


	  <div class="col-lg-3 col-md-3 col-sm-3">
			<!-- CATEGORY START -->
		<div class="category" style="position: sticky;top: 0;z-index: 999;">
			<h4 class="bg-dark text-white text-center category-text">CATEGORIES</h4>
			<div class="row">
				<div class="col-md-12 col-sm-2">
					<a href="#Hot_Coffees">
						<button class="btn btn-lg CustomButton">Hot Coffees</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Hot_Teas">
						<button class="btn btn-lg CustomButton">Hot Teas</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Hot_Drinks">
						<button class="btn btn-lg CustomButton">Hot Drinks</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Coffee_Frappuccino">
						<button class="btn btn-lg CustomButton">Coffee Frappuccino</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Cold_Coffees">
						<button class="btn btn-lg CustomButton">Cold Coffees</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Iced_Teas">
						<button class="btn btn-lg CustomButton">Iced Teas</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Cold_Drinks">
						<button class="btn btn-lg CustomButton">Cold Drinks</button>
					</a>
				</div>
				<div class="col-md-12 col-sm-2">
					<a href="#Home_Coffee">
						<button class="btn btn-lg CustomButton">Home Coffee</button>
					</a>
				</div>
			</div>
		</div>
		<!-- CATEGORY END -->
	  </div>
	  <div class="col-lg-9 col-md-9 col-sm-9">
			
		<!-- Hot_Coffees START-->
		<section id="Hot_Coffees">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Hot Coffees</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         
		          <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Hot Coffees"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-12 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?=$base_url?><?= $row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Hot_Coffees END-->

		<!-- Hot_Teas START-->
		<section id="Hot_Teas">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Hot Teas</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		          <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Hot Teas"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Hot_Teas END-->

		<!-- Hot_Drinks START-->
		<section id="Hot_Drinks">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Hot Drinks</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Hot Drinks"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Hot_Drinks END-->

				<!-- Coffee Frappuccino START-->
		<section id="Coffee_Frappuccino">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Some Best <span> Coffee Frappuccino </span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		          <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Coffee Frappuccino"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Coffee Frappuccino END-->

		<!-- Cold Coffees START-->
		<section id="Cold_Coffees">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span> Cold Coffees </span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Cold Coffees"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Cold Coffees END-->

		<!-- Iced Teas START-->
		<section id="Iced_Teas">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Iced Teas</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Iced Teas"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Iced Teas END-->

		<!-- Cold Drinks START-->
		<section id="Cold_Drinks">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Cold Drinks</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Cold Drinks"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Cold Drinks END-->

		<!-- Home Coffee START-->
		<section id="Home_Coffee">
			<div class="home_post_container">	    
			    <div class="home_post">
			    	<!--SECTION CONTENT START-->
	            	<div class="section-content">
	                	<h2>Best <span>Home Coffee</span> Collection</h2>
	                </div>
                	<!--SECTION CONTENT END-->
		         <ul class="row">
		          	<?php
		          	$sql = 'SELECT * FROM `products` WHERE product_category="Home Coffee"';
		          	$result = run_query($sql);
		          	while ($row = $result->fetch_assoc() ) {
		          	?>	
		          	<li class="col-md-4 col-sm-4 book_item_pro">
		        		<div class="row book_card">
		        			<div class="col-md-5">
		        			   <div class="thumbnail">
		        				  <figure><img src="<?= $base_url.$row['product_image']?>" height="150" class="image-fluid w-100"></figure>	
		        			   </div>
		        			 </div>
		        			 <div class="col-md-7">
		        			 	<div class="caption">
		        					<h3 class="m-0"> <?= $row['product_title']?> </h3>
		        					<p class="title text-muted mb-2"><?= $row['product_category']?></p>
		        					<p class="price mb-2">Price : $<?= $row['product_price']?> </p>
		        					<a href="<?=$base_url?>products/order.php?id=<?=$row['productID']?>" class="btn btn-sm btn-outline-info mb-3"> ADD TO CART <i class="fas fa-cart-plus"></i> </a>
		        				</div>
		        			 </div>
		        		</div>
		        	 </li>
		        	<?php	}?>
		           </ul>
			    </div>
			 </div>
		</section>
		<!-- Home Coffee END-->

	  </div>
	</div>

	<!-- MENU STORE END-->
</body>
	<?php
	include '../includes/footer.php';
	?>
