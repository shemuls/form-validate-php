<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<?php 

		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$databasename = "amar_tech";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $databasename);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		// Get value from input
		$nameErr = $bioErr = $jobErr = $genderErr = $WebsiteUrlErr = $phoneErr = $mailErr = $photoErr = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['name'])) {
				$nameErr = "<p class='text-danger'> Name is required </p>";
			}else{
				$name = input_value_checker($_POST["name"]);
			}

			if (empty($_POST['bio'])) {
				$bioErr = "<p class='text-danger'> Bio is required </p>";
			}else{
				$bio = input_value_checker($_POST["bio"]);
			}

			if (empty($_POST['job'])) {
				$jobErr = "<p class='text-danger'> Job is required </p>";
			}else{
				$job = input_value_checker($_POST["job"]);
			}

			if (empty($_POST['gender'])) {
				$genderErr = "<p class='text-danger'> Job is required </p>";
			}else{
				$gender = input_value_checker($_POST["gender"]);
			}

			if (empty($_POST['gender'])) {
				$genderErr = "<p class='text-danger'> Select Gender is required </p>";
			}else{
				$gender = input_value_checker($_POST["gender"]);
			}

			if (empty($_POST['websiteurl'])) {
				$WebsiteUrlErr = "<p class='text-danger'> Website Url is required </p>";
			}else{
				$websiteUrl = input_value_checker($_POST["websiteurl"]);
				// check validation of URL
				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$websiteUrl)) {
					$WebsiteUrlErr = "<p class='text-danger'>Invalid URL</p>"; 
				 }
			}

			if (empty($_POST['phone'])) {
				$phoneErr = "<p class='text-danger'> Phone is required </p>";
			}else{
				$phone = input_value_checker($_POST["phone"]);
			}

			if (empty($_POST['mail'])) {
				$mailErr = "<p class='text-danger'> Mail is required </p>";
			}else{
				$mail = input_value_checker($_POST["mail"]);
				// check if e-mail address is well-formed
				if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
					$mailErr = "<p class='text-danger'>Invalid email format</p>"; 
				 }
			}

			if (empty($_FILES['photo'])) {
				$photoErr = "<p class='text-danger'> Photo is required </p>";
			}else{
				$photo 					= $_FILES["photo"]['name'];
				$photo_tmp_name 		= $_FILES['photo']['tmp_name'];
				$photo_divide_form_dot 	= explode('.', $photo );
				$photo_formate_ext 		= end($photo_divide_form_dot);
				$unique_photo_name		= md5(time().$photo).'.'.$photo_formate_ext ;
				move_uploaded_file( $photo_tmp_name , 'img/'.$unique_photo_name);
			}
			
		}
		// Form Input Value checker function
		function input_value_checker($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		  }


	?>

	
		<section class="product-details pt-5">
			<div class="container">
				<div class="row d-flex align-items-center">
					<div class="col-md-5">
						<div class="card">
							<h5 class="card-header info-color white-text text-center py-4">
								<strong>Instant Profile With PHP</strong>
							</h5>
						<div class="card-body px-lg-5">
							<form action="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >

								<div class="form-group">
									<label class="control-label"> Your Name </label>
									<input class="form-control" name="name" type="text" placeholder="Name">
									<?php echo $nameErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Short Bio </label>
									<textarea class="form-control" name="bio" type="textarea" placeholder="Bio" cols="30" rows="3"></textarea>
									<?php echo $bioErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Job Title </label>
									<input class="form-control" name="job" type="text" placeholder="job">
									<?php echo $jobErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Gender </label>
									<div class="form-check">
										<input name="gender" class="form-check-input" type="radio" name="exampleRadios" id="male" value="male">
										<label class="form-check-label" for="male">
											Male
										</label>
									</div>
									<div class="form-check">
										<input name="gender" class="form-check-input" type="radio" name="exampleRadios" id="female" value="female">
										<label class="form-check-label" for="female">
											Female
										</label>
									</div>
									<?php echo $genderErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Website Url </label>
									<input class="form-control" name="websiteurl" type="text" placeholder="website url">
									<?php echo $WebsiteUrlErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Phone </label>
									<input class="form-control" name="phone" type="text" placeholder="Phone">
									<?php echo $phoneErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Mail </label>
									<input class="form-control" name="mail" type="mail" placeholder="Mail">
									<?php echo $mailErr; ?>
								</div>
								<div class="form-group">
									<label class="control-label"> Choose Your photo </label>
									<input class="" name="photo" type="file" placeholder="Choose">
									<?php echo $photoErr; ?>
								</div>

								<input class="btn btn-success" name="submit" type="submit" value="Insert">
							</form>

							</div>
						</div>
					</div>

					<div class="col-md-7">
						<div class="card">
							<div class="my-photo" style="height: 200px; width: 150px;padding-left: 20px; background-image: url(img/<?php if (isset($unique_photo_name)) { print_r($unique_photo_name); }?>); background-repeat: no-repeat; background-size: cover;">
								
							</div>
							
							<div class="card-body">
								<h5 class="card-title">Name: 
									<?php if (isset($name)) { echo $name; } ?>
								</h5>
								<p class="card-text">Bio: </p>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item"><strong>Gender:</strong> <?php if (isset($gender)) { echo $gender; } ?></li>
								<li class="list-group-item"><strong>Job Title:</strong> <?php if (isset($job)) { echo $job; } ?></li>
								<li class="list-group-item"><strong>WEbsite:</strong> <?php if (isset($websiteUrl)) { echo $websiteUrl; } ?></li>
								<li class="list-group-item"><strong>Phone:</strong> <?php if (isset($phone)) { echo $phone; } ?></li>
								<li class="list-group-item"><strong>Mail:</strong> <?php if (isset($mail)) { echo $mail; } ?></li>
								<li class="list-group-item"><strong>Mail:</strong> <?php if (isset($mail)) { print_r($mail); }?></li>
							</ul>
							<div class="card-body">
								<a href="#" class="card-link btn btn-primary">Facebook</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


	
	


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>