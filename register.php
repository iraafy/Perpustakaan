<?php

	include 'conn.php';
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
	
	<title>Register</title>
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
						<a class="nav-link" href="login.php">Login&emsp;</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="col-lg-6 offset-lg-3 offset-md-3 mt-5">
		<div class="p-5">
			<H1 class="text-center mb-3">
				REGISTRASI
			</H1>

			<div class="card-text">				
				<form method="post">
					<div class="mb-3">
						<label for="nama" class="form-label">Nama</label>
						<input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap">
					</div>

					<label for="jk" class="mb-2">Jenis Kelamin</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="P" name="jk" id="jk1">
						<label class="form-check-label" for="jk1">
							Perempuan
						</label>
					</div>
					<div class="form-check mb-3">
						<input class="form-check-input" type="radio" value="L" name="jk" id="jk2">
						<label class="form-check-label" for="jk2">
							Laki-Laki
						</label>
					</div>

					<div class="mb-3">
						<label for="jurusan" class="form-label">Jurusan</label>
						<input type="text" name="jurusan" class="form-control" id="jurusan" placeholder="Masukkan Jurusan">
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
					</div>

					<div class="mb-3">
						<label for="telepon" class="form-label">Nomor telepon</label>
						<input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan Nomor Telepon">
					</div>
					
					<div class="mb-3">
						<label for="alamat" class="form-label"> Alamat</label>
						<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat">
					</div>

					<div class="mb-4">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control" id="passwordHelpBlock" placeholder="Masukkan Password">
						<div id="passwordHelpBlock" class="form-text"> Your password must be 5-8 characters long, contain letters and numbers.</div>
					</div>

					<div class="d-grid mb-1 mt-5">
						<button type="submit" name="register" class="btn btn-block btn-primary">Daftar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php

    function rand_string( $length ) 
    {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);
	}

	function registrasi($data)
	{
		global $conn;
		$kode = rand_string(4);
		$nama = $_POST["nama"];
		$jk = $_POST["jk"];
		$jurusan = $_POST["jurusan"];
		$email = $_POST["email"];
		$telepon = $_POST["telepon"];
		$alamat = $_POST["alamat"];
		$password = $_POST["password"];
		//cek duplicate email
		$result = mysqli_query($conn, "SELECT email_anggota FROM anggota WHERE email_anggota = '$email'");
		if( mysqli_fetch_assoc($result) )
		{
			echo "<script>
					alert('email sudah terdaftar!');
				</script>";
			return false;
		}
		
		//add to db
		mysqli_query($conn, "INSERT INTO anggota VALUES('', '$kode', '$nama', '$jk', '$jurusan', '$email', '$telepon', '$alamat', '$password')");

		return mysqli_affected_rows($conn);

	}

	if( isset($_POST["register"]) ) 
	{

		if( registrasi($_POST) > 0 ) 
		{
			echo "<script>
					alert('user baru berhasil ditambahkan');
				</script>";
		}
		else
		{
			echo mysqli_error($conn);
		}
	}

?>