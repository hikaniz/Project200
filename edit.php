	<?php
		include '../controllers/common.php';
		check_if_not_loggedIn();
		check_for_userType_admin();
		include '../includes/header.php';
		include '../includes/navbar.php';

		if (isset($_GET['id'])) {
			$_SESSION['productID'] = $_GET['id'];
		}

		if (isset($_SESSION['productID'])) {
			$sql = 'SELECT * FROM `products` WHERE productID = '.$_SESSION['productID'].'';
			$response = run_query($sql);
			$row = $response->fetch_assoc();
		}


		$error = null;
		$success = FALSE;

		if(count($_POST) > 0){

				if(empty($_FILES['image']["name"])) {
					 	$image_path = $row['product_image'];
					 }else{
					 	$target_dir = 'C:\xampp\htdocs\171-115-224\uploads\product\\';
						$target_file = $target_dir . basename($_FILES["image"]["name"]);
						$image_path = 'uploads/product/' . basename($_FILES["image"]["name"]);
						$error = validate_img($_FILES, $target_file);
					 } 

			if(!$error){

				$sql = 'UPDATE `products` SET product_title="'.$_POST['product_title'].'", product_image="'.$image_path.'", product_price="'.$_POST['product_price'].'", product_category="'.$_POST['product_category'].'" WHERE productID = '.$_POST['product_id'].' ';
				$response = run_query($sql);
				if($response){
					$success = TRUE;
				}
			}
		}
	?>

		<!-- START	-->
	<section style="background: #364f69;padding: 30px;">
		<div class="container bg-light pt-3 mb-5 width100" style="width: 70%;margin-top: 120px;border-radius: 15px;">
			<form method="post" action="<?=$base_url?>products/edit.php" class="bg-light p-5" enctype="multipart/form-data">
				<h3 class="text-center text-info">UPDATE PRODUCT DETAILS</h3>
				<?php
				 if($error){
				 	echo '<div class="alert alert-danger">'.$error.'</div>';
				 	}
				 ?>
				 <?php
				 if($success){
					 echo '<div class="alert alert-success">Product Successfully Updated!!</div>';
				 	}
				 ?>
				 <div class="form-group text-center bg-success text-white">
					<label>Product ID : </label>
					<input type="text" name="product_id" class="bg-success text-white border-0 text-center" value="<?=$row['productID']?>" style="width: 10%;" readonly>
				</div>
				<div class="form-group">
					<label> Product TITLE : </label>
					<input type="text" name="product_title" class="form-control" placeholder="Enter Product Title" value="<?=$row['product_title']?>" required>
				</div>
				<div class="form-group">
					<div class="float-right"><figure class="thumbnail"><img src="<?= $base_url.$row['product_image']?>" width="100" height="120"></figure></div>
					<label>UPDATE THUMBNAIL : </label>
					<input type="file" name="image" class="form-control border-0" style="width: 75%;">
				</div>
				<div class="form-group">
					<label>CATEGORY : </label>
					<select name="product_category" required>
						  <option value="<?= $row['product_category']?>" selected> <?= $row['product_category']?> </option>
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
					<label>PRICE : </label>
					<input type="number" name="product_price" placeholder="Enter Product Price" value="<?= $row['product_price'] ?>" required>				
				</div>
				<button type="submit" class="btn btn-outline-success form-control">UPDATE PRODUCT</button>	
			</form>
		</div>
	</section>

		<!--END	-->

	<?php
	include '../includes/footer.php';
	?>

