<?php

	if (!defined('BASE')) die('<h1>Restricted access!</h1>');

	define('DBHOST', 'localhost:3306');
    define('DBUSER', 'pizk7883');
    define('DBPASS', 'K875xvUCSZSj57');
    define('DBNAME', 'pizk7883_pizza_resto');

	class Database{
		protected $conn = NULL;

        function __construct() {
            $this->conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

            if (mysqli_connect_error()) {
                $this->conn = NULL;
                die('Error: Failed to connect to database (' . mysqli_connect_errno() . ')');
            }
        }

		function error() {
            return $this->conn->error;
        }
	}

	class RestoDB extends Database {
		public function insert_reservasi($nama, $telp, $email, $jumorg, $date, $pesan)
		{
			$query = "INSERT INTO reservasi(nama_pemesan, telepon, email_pemesan, jumlah_orang, tanggal_reservasi, pesan) VALUES (?, ?, ?, ?, ?, ?)";

			$stmt = $this->conn->prepare($query); // ini tuh prepare statement buat yang tanda tanya itu
			$stmt->bind_param(
				"sssiss", //ini parameternya string string string integer
				$nama,
				$telp,
				$email,
				$jumorg,
				$date,
				$pesan
			);
			return $stmt->execute(); //execute ini untuk kalo ga ngeluarin apa2 dan juga pake ini kalo ad prepare statement
		}

		public function insert_pesanan($nama, $telp, $email, $alamat)
		{
			$query = "INSERT INTO pesanan(nama_pemesan, telepon, email, alamat_pengiriman) VALUES (?, ?, ?, ?)";
			$stmt = $this->conn->prepare($query); // ini tuh prepare statement buat yang tanda tanya itu
			$stmt->bind_param(
				"ssss", //ini parameternya string string string integer
				$nama,
				$telp,
				$email,
				$alamat
			);
			return $stmt->execute();
		}

		// public function select_idorder() {
		// 	// $query = "SELECT id_order FROM pesanan ORDER BY id_order DESC LIMIT 1";
		// 	// $result = $this->conn->query($query);
		// 	// $retval = mysqli_fetch_array($result);
		// 	$retval = 
		// 	return $retval;
		// }

		public function insert_detail_pesanan($menu, $qty)
		{
			//$query = "SELECT id_order FROM pesanan ORDER BY id_order DESC LIMIT 1";
			//$result = select_idorder();
			//echo $result;
			$query = "INSERT INTO detail_pesanan(id_order, id_menu, kuantitas) VALUES ((SELECT id_order FROM pesanan ORDER BY id_order DESC LIMIT 1), ?, ?)";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param(
				"si",
				$menu,
				$qty
			);
			return $stmt->execute();
		}

		public function select_menu_pizza() {
			$query = "SELECT * FROM menu WHERE id_menu LIKE 'pizza%'";
			$retval = array();

			$result = $this->conn->query($query);
			while ($row = mysqli_fetch_array($result)){ // ini di fetch atau di ambil dari result per baris ke row
				array_push($retval, $row); // ini di append atau di push ke retval dari row
			}

			return $retval;
		}

		public function select_menu_pasta() {
			$query = "SELECT * FROM menu WHERE id_menu LIKE 'pasta%'";
			$retval = array();

			$result = $this->conn->query($query);
			while ($row = mysqli_fetch_array($result)){ // ini di fetch atau di ambil dari result per baris ke row
				array_push($retval, $row); // ini di append atau di push ke retval dari row
			}

			return $retval;
		}

		public function select_menu_starter() {
			$query = "SELECT * FROM menu WHERE id_menu LIKE 'start%'";
			$retval = array();

			$result = $this->conn->query($query);
			while ($row = mysqli_fetch_array($result)){ // ini di fetch atau di ambil dari result per baris ke row
				array_push($retval, $row); // ini di append atau di push ke retval dari row
			}

			return $retval;
		}

		public function login_secure($username, $password) {
			$query = "SELECT id_user, password FROM user WHERE username = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s", $username);
			$result = $stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows == 1) {
				$row = mysqli_fetch_array($result);
				// untuk mengecek pass form login dengan hash password, pake pass verif (builtin function)
				if (password_verify($password, $row['password'])) {
					return $row["id_user"];
				}
				else
					return -1;
			}
			return -1;
		}

		public function select_allmenu() {
			$query = "SELECT * FROM menu";
			$retval = array();

			$result = $this->conn->query($query);
			while ($row = mysqli_fetch_array($result)){ // ini di fetch atau di ambil dari result per baris ke row
				array_push($retval, $row); // ini di append atau di push ke retval dari row
			}

			return $retval;
		}

		public function update_menu($id_menu, $nama_menu, $ket_menu, $harga) {
			$query = "UPDATE menu SET nama_menu = ?, keterangan_menu = ?, harga= ? WHERE id_menu = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param(
				"ssis",
				$nama_menu,
				$ket_menu,
				$harga,
				$id_menu
			);
			return $stmt->execute();
		}

		public function select_by_id($id_menu) {
			$query = "SELECT * FROM menu WHERE id_menu = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s", $id_menu);
			$result = $stmt->execute();
			$result = $stmt->get_result();
			return mysqli_fetch_array($result);
		}

		public function delete($id_menu) {
			$query = "DELETE FROM menu WHERE id_menu = ?";
			$stmt = $this->conn->prepare($query); 
			$stmt->bind_param("s", $id_menu);
			return $stmt->execute();
		}

		public function insert_menu($id_menu, $nama_menu, $keterangan_menu, $harga)
		{
			$query = "INSERT INTO menu(id_menu, nama_menu, keterangan_menu, harga) VALUES (?, ?, ?, ?)";

			$stmt = $this->conn->prepare($query); // ini tuh prepare statement buat yang tanda tanya itu
			$stmt->bind_param(
				"sssi", //ini parameternya string string string integer
				$id_menu,
				$nama_menu,
				$keterangan_menu,
				$harga
			);
			return $stmt->execute(); //execute ini untuk kalo ga ngeluarin apa2 dan juga pake ini kalo ad prepare statement
		}
	}
?>