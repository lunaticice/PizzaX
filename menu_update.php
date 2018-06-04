<?php
	session_start();
	if (!isset($_SESSION["loggedIn"])){
		header("Location: login_admin.php");
		exit();
	}

	define('BASE', 'BASE');
	require_once("database/Database.php");

	$db=new RestoDB();

	if ($_POST) {
		$id_menu = trim($_POST['id_menu']);
		$nama_menu = trim($_POST['nama_menu']);
		$keterangan_menu = trim($_POST['keterangan_menu']);
		$harga = trim($_POST['harga']);

		$errors = array();
		if (strlen($nama_menu) == 0)
			array_push($errors, "Nama Menu harus diisi");
		if (strlen($keterangan_menu) == 0)
			array_push($errors, "Keterangan menu harus diisi");
		if (strlen($harga) == 0)
			array_push($errors, "Harga harus diisi");

		if (count($errors) == 0) {
			if($db->update_menu($id_menu, $nama_menu, $keterangan_menu, $harga)) {
				header("Location: menu_admin.php");
				exit();
			}
			else
				array_push($errors, "Gagal mengubah menu");
		}
	}

	$menu = isset($_GET['id']) ? $db->select_by_id($_GET['id']) : array();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<!-- Stylesheets -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!--// Stylesheets -->
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
	<!--//fonts-->
</head>
<body>
	<h1 class="w3-jumbo" style="text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred">Update Menu</h1>
	<?php if($_POST && (count($errors) > 0)) { ?>
	<p style="color:red">
		<strong>Errors</strong>
		<ul>
			<?php foreach ($errors as $error) { ?>
				<li><?php echo $erorr; ?></li>
			<?php } ?>
		</ul>
	</p>
	<?php } ?>

	<div class="w3ls-login w3-animate-opacity">
		<form method="post" action="menu_update.php">
			<input type="hidden" name="id_menu" value="<?php echo $menu['id_menu']; ?>">

			<div class="agile-field-txt">
				<label class="w3-xlarge w3-text-red" style="float: none;font-weight: bolder;">
				<i class="fa" aria-hidden="true"></i>Data Menu yang Diubah:</label>
			</div>

			<div class="agile-field-txt">
				<label class="w3-large">
					<i class="fa" aria-hidden="true"></i>Nama Menu</label>
				<input type="text" name="nama_menu" value="<?php echo $menu['nama_menu']; ?>" maxlength="25">
			</div>

			<div class="agile-field-txt">
				<label class="w3-large">
					<i class="fa" aria-hidden="true"></i>Keterangan Menu</label>
					<input type="text" name="keterangan_menu" value="<?php echo $menu['keterangan_menu']; ?>" maxlength="150">
			</div>

			<div class="agile-field-txt">
				<label class="w3-large">
					<i class="fa" aria-hidden="true"></i>Harga Menu</label>
				<input type="text" name="harga" value="<?php echo $menu['harga']; ?>" maxlength="7">
			</div>

			<div class="w3ls-login  w3l-sub">
				<input type="submit" name="submit" value="Save">
			</div>
			<div class="w3ls-login  w3l-sub w3-large">
				<a href="menu_admin.php">Cancel</a>
			</div>
		</form>
	</div>
</body>
</html>