<?php

	include 'conn.php';
	session_start();
	$buku = mysqli_query($conn, 'SELECT * FROM buku'); 

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
						<a class="nav-link active" href="index.php">Home&emsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="riwayat.php">Riwayat&emsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">
							<?php
								if(!isset($_SESSION["login"])) {
									echo "Login";
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
		<div class="row">
			<?php foreach ($buku as $resultBuku) { ?>
				<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"><?= $resultBuku['judul_buku']; ?></h5>
							<p class="card-text">Penulis : <?= $resultBuku['penulis_buku']; ?> <br> Tahun : <?= $resultBuku['tahun_penerbit']; ?> <br> Stok : <?= $resultBuku['stok']; ?></p>
							<!-- Button trigger modal -->
							<?php if(isset($_SESSION["login"])) { ?>
								<a href="detail.php?id_buku=<?php echo $resultBuku['id_buku']; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $resultBuku['id_buku']; ?>"><span class="iconify-inline" data-icon="fa6-solid:cart-plus" style="color: white;"></span> Pinjam </a>
							<?php } else { ?>	 
								<a href="login.php" class="btn btn-primary"><span class="iconify-inline" data-icon="fa6-solid:cart-plus" style="color: white;"></span> Pinjam </a> 
							<?php } ?>
							<!-- Modal -->
							<div class="modal fade" id="exampleModal-<?php echo $resultBuku['id_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable">
									<div class="modal-content">
										<form method="post">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Detail Info</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body" style="text-align: justify">
												<table class="table">
													<!-- <tr hidden="hidden"> -->
													<tr>
														<td>
															ID Buku
														</td>
														<td>
															: <?php echo $resultBuku['id_buku']; ?>
															<input type="text" value=<?= $resultBuku['id_buku']; ?> name="id_buku" id="id_buku" hidden>
														</td>
													</tr>
													<tr>
														<td>
															Kode Buku
														</td>
														<td>
															: <?php echo $resultBuku['kode_buku'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Judul Buku
														</td>
														<td>
															: <?php echo $resultBuku['judul_buku'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Penulis Buku
														</td>
														<td>
															: <?php echo $resultBuku['penulis_buku'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Penerbit Buku
														</td>
														<td>
															: <?php echo $resultBuku['penerbit_buku'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Tahun Penerbit
														</td>
														<td>
															: <?php echo $resultBuku['tahun_penerbit'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Stok
														</td>
														<td>
															: <?php echo $resultBuku['stok'] ?>
														</td>
													</tr>
													<tr>
														<td>
															Tanggal Peminjaman
														</td>
														<td>
															: <?= date("m/d/Y") ?>
														</td>
													</tr>
													<tr>
														<td>
															Tanggal Pengembalian
														</td>
														<td>
															: <input type="date" name="pengembalian" id="pengembalian" required>
														</td>
													</tr>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
												<button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
											</div>
										</form>
									</div>
								</div>
							</div>					
						</div>
					</div>					
				</div>
			<?php } ?>
		</div>
	</div>

	<script>
		var myModal = document.getElementById('myModal')
		var myInput = document.getElementById('myInput')

		myModal.addEventListener('shown.bs.modal', function () {
		myInput.focus()
		})
	</script>
	<!-- iconify -->
	<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php

	function pinjam_buku($data)
	{
		global $conn;
		$tgl_pinjam = date("Y/m/d");
		$tgl_kembali = $_POST["pengembalian"];
		$id_buku = $_POST["id_buku"];
		$id_anggota = $_SESSION["id_anggota"];
		
		//add to db
		mysqli_query($conn, "INSERT INTO peminjaman VALUES('', '$tgl_pinjam', '$tgl_kembali', '0', '$id_buku', '$id_anggota')");

		return mysqli_affected_rows($conn);

	}

	if( isset($_POST["pinjam"]) ) 
	{

		if( pinjam_buku($_POST) > 0 ) 
		{
			echo "<script>
					alert('Buku berhasil dipinjam');
				</script>";
		}
		else
		{
			echo mysqli_error($conn);
		}
	}

?>