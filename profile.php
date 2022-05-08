<?php
	include 'conn.php';
	session_start();
	if( !isset($_SESSION["login"]))
	{
		header("Location: login.php");
		exit;
	}
	$sukses = 0;
	$user = mysqli_query($conn, 'SELECT * FROM anggota'); 

	function edit($data)
	{
		global $conn;
        $id = $_POST["id"];
		$kode = $_POST["kode"];
		$nama = $_POST["nama"];
		$jk = $_POST["jk"];
		$jurusan = $_POST["jurusan"];
		$email = $_POST["email"];
		$telepon = $_POST["telepon"];
		$alamat = $_POST["alamat"];
		$password = $_POST["password"];
		
		//add to db
		mysqli_query($conn, "UPDATE anggota SET id_anggota='$id', kode_anggota='$kode', nama_anggota='$nama', jk_anggota='$jk', jurusan_anggota='$jurusan', email_anggota='$email', no_telp_anggota='$telepon', alamat_anggota='$alamat', password='$password'");

		return mysqli_affected_rows($conn);

	}

	if( isset($_POST["edit"]) ) 
	{

		if( edit($_POST) > 0 ) 
		{
			$sukses = 1;
			header("Refresh: 1; url=profile.php");
		}
		else
		{
			echo mysqli_error($conn);
		}
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
	<link rel="stylesheet" href="style.css">
	<title>Perpustakaan</title>
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
						<a class="nav-link" href="index.php">Home&emsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="riwayat.php">Riwayat&emsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="profile.php">
							<?php
								if(!isset($_SESSION["login"])) {
									echo "Profile";
								} else {
									echo $_SESSION['nama_anggota'];
								}
							?>
						&emsp;</a>
					</li>
					<li class="nav-item">
						<?php
							if(isset($_SESSION["login"])) {
								echo 
								"
								<a class='nav-link' href='logout.php'>
									<span class='iconify-inline' data-icon='carbon:logout'></span>
								</a>
								";
							}
						?>
					</li>
				</ul>
			</div>
		</div>
	</nav>

    <div class="container mt-5 pt-5">
        <div class="row mt-3">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 border-right p-3">
                <div class="card" style="box-shadow: 2px 2px 10px 1px rgba(0,0,0,0.30);">
                    <div class="card-body pb-5">
                        <img class="rounded-circle mx-auto d-block mt-5 mb-4" style="border: 4px solid #5e5e5e;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/512px-Breezeicons-actions-22-im-user.svg.png" width="90">
                        <div class="text-center mt-5 mb-5">
                            <?php foreach ($user as $key) { ?>
                                <?php if ($key['id_anggota'] == $_SESSION["id_anggota"]) { ?>
                                    <h6 class="font-weight-bold"><?php echo $key['email_anggota']; ?> </h6>
                                    <h6 class="text-black-50"><?php echo $key['jurusan_anggota']; ?> </h6>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-4 col-sm-12 col-12 border-right p-3">
				<h4>
					Edit Profile
				</h4>
				<?php if ($sukses == 1) { ?>
					<p style="color: green">
						Data sedang diubah.
					</p>
				<?php } ?>
				<form action="" method="post">
					<div class="text-center mt-4">
						<?php foreach ($user as $key) { ?>
							<?php if ($key['id_anggota'] == $_SESSION["id_anggota"]) { ?>
								<input type="text" class="form-control" value="<?= $key['id_anggota'] ?>" name="id" hidden>
								<input type="text" class="form-control" value="<?= $key['kode_anggota'] ?>" name="kode" hidden>
								<input type="text" class="form-control" value="<?= $key['nama_anggota'] ?>" name="nama">
								<br>
								<input type="text" class="form-control" value="<?= $key['jk_anggota'] ?>" name="jk" hidden>
								<input type="text" class="form-control" value="<?= $key['jurusan_anggota'] ?>" name="jurusan">
								<br>
								<input type="text" class="form-control" value="<?= $key['email_anggota'] ?>" name="email">
								<br>
								<input type="text" class="form-control" value="<?= $key['no_telp_anggota'] ?>" name="telepon">
								<br>
								<input type="text" class="form-control" value="<?= $key['alamat_anggota'] ?>" name="alamat">
								<br>
								<input type="text" class="form-control" value="<?= $key['password'] ?>" name="password" hidden>
							<?php } ?>
						<?php } ?>
					</div>
					<button type="submit" class="btn btn-primary" style="float: right" name="edit">Edit Data</button>
				</form>
			</div>

        </div>
    </div>
    <br><br><br>

	<!-- iconify -->
	<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php



?>