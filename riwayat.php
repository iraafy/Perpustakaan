<?php

	session_start();
	if( !isset($_SESSION["login"]))
    {
        header("Location: login.php");
        exit;
    }
    include 'conn.php';
    $find_anggota = mysqli_query($conn, 'select * from anggota;');
    $find = mysqli_query($conn, 'select * from buku;');
	$data_pinjam = mysqli_query($conn, 'Select kode_buku, judul_buku, tanggal_pinjam, tanggal_kembali, sudah_dikembalikan, id_anggota, id_peminjaman from buku a join peminjaman b on a.id_buku = b.id_buku'); 
?>

<!doctype html>
<html lang="en">
<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Perpustakaan</title>
	<link rel="stylesheet" href="tyle.css">

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
						<a class="nav-link active" href="riwayat.php"><b>Riwayat</b>&emsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">
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

	<div class="container mt-5">
        <br><br>
        <h3>
            <b> Riwayat Peminjaman </b>
        </h3>
		<div style="overflow-x:auto;">
			<table class="table mt-5" style="text-align: center;">
				<thead>
					<tr>
						<th>Kode Buku</th>
						<th>Judul Buku</th>
						<th>Tanggal Peminjaman</th>
						<th>Tanggal Pengembalian</th>
						<th>OPSI</th>
					</tr>
				</thead>
				<tbody id="tampil">
                    <?php $getAnggota = $_SESSION["id_anggota"] ?>
                    <?php foreach ($data_pinjam as $data) { ?>
                        <?php if ($data['id_anggota'] == $getAnggota) { ?>
                            <tr>
                                <td><?php echo $data['kode_buku'] ?> </td>
                                <td><?php echo $data['judul_buku'] ?> </td>
                                <td><?php echo $data['tanggal_pinjam'] ?> </td>
                                <td><?php echo $data['tanggal_kembali'] ?> </td>
                                <td>
									<?php if ($data['sudah_dikembalikan'] == "1") { ?>
										<a href="pengembalian.php?id_peminjaman=<?php echo $data['id_peminjaman']; ?>" class="btn disabled" style="background-color: lightgrey; color: black;">Sudah Dikembalikan</a>
									<?php } else { ?>
										<a href="pengembalian.php?id_peminjaman=<?php echo $data['id_peminjaman']; ?>" class="btn btn-primary">Kembalikan</a>
									<?php } ?>
                                </td>
                            </tr>
					    <?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<br><br><br>

	<!-- iconify -->
	<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>