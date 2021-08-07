	<?php
		include '../controllers/common.php';
		check_if_not_loggedIn();
		check_for_userType_admin();
		include '../includes/header.php';
		include '../includes/navbar.php';

		$error = null;
		$success = FALSE;

		if(count($_POST) > 0){
	 
				$target_dir = 'C:\xampp\htdocs\171-115-224\uploads\product\\';
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$image_path = 'uploads/product/' . basename($_FILES["image"]["name"]);
				$error = validate_img($_FILES, $target_file);

			if(!$error){
				date_default_timezone_set("Asia/Dhaka");
				$now = date('d-M-Y');
				$sql = 'INSERT INTO `products` (product_title, product_image, product_price, product_category, created_at,userID) 
						VALUES("' .$_POST['product_title']. '", "'.$image_path.'", "' .$_POST['product_price']. '", "'.$_POST['product_category'].'","'.$now.'","'.$_SESSION['userID'].'")';	
				$response = run_query($sql);
				if($response){
					$success = TRUE;
				}
			}
		}
	?>

		<!--	ADD Product START	-->
	<section style="background: #364f69;padding: 30px;">
		<div class="container bg-light pt-3 mb-5 width100" style="width: 70%;margin-top: 120px;border-radius: 15px;">
			<form method="post" action="<?=$base_url?>products/add_product.php" class="bg-light p-5" enctype="multipart/form-data">
				<h3 class="text-center text-success">ADD NEW PRODUCT</h3>
				<?php
				 if($error){
				 	echo '<div class="alert alert-danger">'.$error.'</div>';
				 	}
				 ?>
				 <?php
				 if($success){
					 echo '<div class="alert alert-success">Product Successfully added!!</div>';
				 	}
				 ?>
				<div class="form-group">
					<label>Product Title : </label>
					<input type="text" name="product_title" class="form-control" placeholder="Enter Product Title" required>
				</div>
				<div class="form-group">
					<label>Add Book Thumbnail : </label>
					<input type="file" name="image" class="form-control border-0" required>
				</div>
				<div class="form-group">
					<label>Product Category : </label>
					<select name="product_category" class="form-control" required>
						  <option value="Hot Coffees">Hot Coffees</option>
						  <option value="Hot Teas">Hot Teas</option>
						  <option value="Hot Drinks">Hot Drinks</option>
						  <option value="Coffee Frappuccino">Coffee Frappuccino</option>
						  <option value="Cold Coffees">Cold Coffees</option>
						  <option value="Iced Teas">Iced Teas</option>
						  <option value="Cold Drinks">Cold Drinks</option>
						  <option value="Home Coffee">Home Coffee</option>
					</select>
				</div>
				<div class="form-group">
					<label>Price : </label>
					<input type="number" name="product_price" placeholder="Enter Product Price" required>				
				</div>
				<button type="submit" class="btn btn-outline-success form-control">Submit</button>	
			</form>
		</div>
	</section>

		<!--	ADD Product END	-->

	<?php
	include '../includes/footer.php';
	?>

