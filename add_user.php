	<?php
		include '../controllers/common.php';
		check_if_not_loggedIn();
		check_for_userType_admin();
		include '../includes/header.php';
		include '../includes/navbar.php';

		$error = null;
		$success = FALSE;

		if(count($_POST) > 0){

			if(!$error){
				$query = 'SELECT user_email FROM `users` WHERE user_email="'.$_POST['email'].'"';
				$response = run_query($query);
				$countrow = $response->num_rows;
				if($countrow > 0){
					$error = "Email has already been registered";
				}
			}
	 		if (!$error) {
				$target_dir = 'C:\xampp\htdocs\project\uploads\user\\';
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$image_path = 'uploads/user/' . basename($_FILES["image"]["name"]);
				$error = validate_img($_FILES, $target_file);
				}

			if(!$error){
				date_default_timezone_set("Asia/Dhaka");
				$now = date('h:i:sa d-M-Y');
				$sql = 'INSERT INTO `users` (first_name, last_name, user_email, user_password,gander,birth_date,contact,address,image,user_type,created_on) 
						VALUES("' .$_POST['fname']. '", "'.$_POST['lname'].'", "'.$_POST['email'].'", "'.$_POST['password'].'", "'.$_POST['gander'].'", "'.$_POST['birthDate'].'", "'.$_POST['contact'].'", "'.$_POST['address'].'","'.$image_path.'", "'.$_POST['user_type'].'","'.$now.'")';		
				$response = run_query($sql);
				if($response){
					$success = TRUE;
					$_POST['fname'] = null;
				}
			}
		}
	?>

		<!--	ADD User START	-->
	<section style="background: #364f69;padding: 30px;">
		<div class="container bg-light pt-3 mb-5 width100" style="width: 70%;margin-top: 120px;border-radius: 15px;">
			<form method="post" action="<?=$base_url?>author/add_user.php" class="bg-light p-5" enctype="multipart/form-data">
				<h3 class="text-center text-success">ADD NEW USER</h3>
				<?php
				 if($error){
				 	echo '<div class="alert alert-danger">'.$error.'</div>';
				 	}
				 ?>
				 <?php
				 if($success){
					 echo '<div class="alert alert-success">User Successfully added!!</div>';
				 	}
				 ?>
				<div class="form-group">
					<label>First Name : </label>
					<input type="text" name="fname" class="form-control" placeholder="Enter First Name" required >
					<label>Last Name : </label>
					<input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required>
					<label>Email : </label>
					<input type="email" name="email" class="form-control" placeholder="Enter Email" required>
					<label>Password : </label>
					<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
				</div>
				<div class="form-group">
					<label for="gender">Gender:</label>
					<input type="radio" name="gander" value="male" checked>Male
					<input type="radio" name="gander" value="female">Female
					<input type="radio" name="gander" value="others">Others
				</div>
				<div class="form-group">
					<label for="birthDate">Date of Birth : </label>
					<input type="date" name="birthDate" required><br/>
					<label for="contact">Contact : </label>
					<input type="number" name="contact" required class="form-control" placeholder="Enter Contact Number">
					<label for="address">Address : </label>
					<input type="text" name="address" required class="form-control" placeholder="Enter Address">
				</div>
				<div class="form-group">
					<label>Add User Image : </label>
					<input type="file" name="image" class="form-control border-0" required>
				</div>
				<div class="form-group">
					<label>User Type : </label>
					<select name="user_type" required>
						  <option value="visitor">Visitor</option>
						  <option value="admin">Admin</option>
					</select>
				</div>
				<button type="submit" class="btn btn-outline-success form-control">Submit</button>	
			</form>
		</div>
	</section>

		<!--	ADD BOOK END	-->

	<?php
	include '../includes/footer.php';
	?>

