<?php
	session_start();
	if (!isset($_SESSION["loggedIn"])){
		header("Location: login_admin.php");
		exit();
	}
?>

<html>
	<head>
		<title>Pizza Menu Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">

		<!-- Stylesheets -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!--// Stylesheets -->
		<!--fonts-->
		<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
		<!--//fonts-->
	</head>
	<body>
		<h1 class="w3-jumbo w3-animate-top" style="text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred;font-family:sans-serif;">Organize Menu</h1>
		<div class="w3-padding-left">
			<a href="menu_insert.php" class="w3-button w3-xlarge w3-red w3-text-white w3-animate-top w3-hover-brown">Insert New Menu</a>
		</div>
		<?php
			define('BASE', 'BASE');
			require_once("database/Database.php");

			$db = new RestoDB();

			$menus = $db->select_allmenu();
			//print_r($books); //kalo mw print array itu pake print_r
		?>
		<div class="w3-container w3-padding-small w3-large w3-animate-opacity">
		<table class="table table-bordered">
			<tr class="w3-orange w3-text-black" style="font-weight: bolder;text-align: center;">
				<th>ID MENU</th>
				<th>MENU</th>
				<th>KETERANGAN</th>
				<th>HARGA</th>
				<th>ACTIONS</th>
			</tr>
			<?php
				foreach ($menus as $menu) {
					echo "<tr class=\"w3-orange w3-greyscale-min\">";
					echo "<td>" . $menu["id_menu"] . "</td>";
					echo "<td>" . $menu["nama_menu"] . "</td>";
					echo "<td>" . $menu["keterangan_menu"] . "</td>";
					echo "<td>" . $menu["harga"] . "</td>";
					echo "<td>";
					//cara untuk membuat banyak spasi pake &nbsp atau cara lain CSS
					//misal buat 4 spasi, maka &nbsp&nbsp&nbsp&nbsp
					echo "<a href='menu_update.php?id=" . $menu['id_menu'] . "'><b>Update</b></a> "; 
					// gmn kita tau tiap tombol update mengarah ke baris khusus tersebut
					//caranya kasi id buku ke tiap link. misal : book_update.php?id=1
					echo "<a href='menu_delete.php?id=" . $menu['id_menu'] . "'>Delete</a>";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</table>
		</div>
		<strong><a class="w3-button w3-block w3-xlarge w3-red w3-animate-bottom w3-hover-brown" href="logout.php">Logout</a></strong>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</body>
</html>