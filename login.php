<?php

	include 'conn.php';
	$error = 0;
	session_start();
	if(isset($_SESSION["login"]))
	{
	    header("Location: index.php");
	    exit;
	}	
	
?>
			
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="https://kit.fontawesome.com/9da43ad1c6.js" crossorigin="anonymous"></script>
	
	<title>Login</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-5" style="box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.35);">
		<div class="container ps-4 pe-4">
			<a class="navbar-brand" href="index.php">
				<b>
					Perpustakaan
				</b>
            </a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
                    <li class="nav-item">
						<a class="nav-link" href="register.php">Registrasi&emsp;</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="col-lg-6 offset-lg-3 offset-md-3 mt-5">
		<div class="p-5">
			<H1 class="text-center mb-5">
				LOGIN
			</H1>
			<div class="card-text">
				<?php if ($error == 1) { ?>
					<nav aria-label="breadcrumb" style="background-color: #ba8888; border-radius: 5px !important;" class="mb-4 p-2">
						<ol class="breadcrumb flex">
							<li class="breadcrumb-item active" aria-current="page" style="color: white;">Data salah, silahkan login kembali</li>
						</ol>
					</nav>
				<?php } ?>
				<form method="post">
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
					</div>

					<div class="mb-1">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
					</div>

					<div class="d-grid mb-1">
						<button type="submit" name="submit" class="btn btn-block btn-primary mt-5">Masuk</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php

	if ( isset($_POST["submit"]) )
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$result = mysqli_query($conn, "SELECT * FROM anggota WHERE email_anggota = '$email' AND password = '$password'");
		if( mysqli_num_rows($result) === 1) 
		{
			$_SESSION["login"] = true;
			$row=mysqli_fetch_assoc( $result );
			$user_id = $row['id_anggota'];
			$_SESSION["id_anggota"] = $user_id;
			$user_name = $row['nama_anggota'];
			$_SESSION["nama_anggota"] = $user_name;
			header("Location: index.php");
			exit;
		}
		else
		{
			$error = 1;
		}
	} 

?>