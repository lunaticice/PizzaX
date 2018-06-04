<?php
  session_start();

  if (isset($_POST['order'])) {
    $pizza_menus = $_SESSION['pizza_menus'];
    $pasta_menus = $_SESSION['pasta_menus'];
    $starter_menus = $_SESSION['starter_menus'];

    $pesanan_pizza = array();
    $pesanan_pasta = array();
    $pesanan_starter = array();
    foreach ($pizza_menus as $pizza) {
      array_push($pesanan_pizza, trim($_POST['qty'.$pizza["id_menu"]]));
    }
    foreach ($pasta_menus as $pasta) {
      array_push($pesanan_pasta, trim($_POST['qty'.$pasta["id_menu"]]));
    }
    foreach ($starter_menus as $starter) {
      array_push($pesanan_starter, trim($_POST['qty'.$starter["id_menu"]]));
    }

    $total = 0;
  }

  if (isset($_POST['placeorder'])) {
    define('BASE', 'BASE');

    $pizza_menus = $_SESSION['pizza_menus'];
    $pasta_menus = $_SESSION['pasta_menus'];
    $starter_menus = $_SESSION['starter_menus'];

    $pesanan_pizza = $_SESSION['pesanan_pizza'];
    $pesanan_pasta = $_SESSION['pesanan_pasta'];
    $pesanan_starter = $_SESSION['pesanan_starter'];

    $Name = trim($_POST['Name']);
    $Telp = trim($_POST['Telp']);
    $Email = trim($_POST['Email']);
    $Address = trim($_POST['Address']);
  
    $errors = array();
    if (strlen($Name) == 0)
      array_push($errors, "Nama harus diisi");
    if (strlen($Telp) == 0)
      array_push($errors, "Nomor Telepon harus diisi");
    if (strlen($Email) == 0)
      array_push($errors, "Email harus diisi");
    if (strlen($Address) == 0)
      array_push($errors, "Alamat harus diisi");

    if (count($errors) == 0) {
      require_once("database/Database.php");
      $db = new RestoDB();

      
      if ($db->insert_pesanan($Name, $Telp, $Email, $Address)){
        $idx = 0;
        foreach ($pesanan_pizza as $i) {
          if($i > 0) {
            $db->insert_detail_pesanan($pizza_menus[$idx]["id_menu"], $i);
          }
          $idx += 1;
        }

        $idx = 0;
        foreach ($pesanan_pasta as $i) {
          if($i > 0) {
            $db->insert_detail_pesanan($pasta_menus[$idx]["id_menu"], $i);
          }
          $idx += 1;
        }

        $idx = 0;
        foreach ($pesanan_starter as $i) {
          if($i > 0) {
            $db->insert_detail_pesanan($starter_menus[$idx]["id_menu"], $i);
          }
          $idx += 1;
        }
        // ke page order success
        header("Location: order_checkout.php");
        exit();
      }
      else
        array_push($erorrs, "Gagal memesan, silahkan cek data anda.");
    }
    }
?>

<!DOCTYPE html>
<html>
<title>PizzaX - Order</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
.menu {display: none}
.bgimg {
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url("https://www.timelinecoverbanner.com/facebook-covers/pizza.jpg");
    min-height: 90%;
}
.qtytext {
  width: 80px;
  height: 40px;
}
.column {
    float: left;
    width: 50%;
    padding: 30px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
<body>
  <?php if (isset($_POST['send']) && (count($errors) > 0)) { ?>
    <p style="color:red">
      <strong>>Errors:</strong>
      <ul>
        <?php foreach ($errors as $error) { // setiap isi dari errors jadi error ?>
          <li><?php echo $error; ?></li>
        <?php } ?>
      </ul>
  </p>
  <?php } ?>

  <!-- Navbar (sit on top) -->
  <div class="w3-top w3-hide-small">
    <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
      <a href="index.php" class="w3-bar-item w3-button">HOME</a>
      <a href="index.php#menu" class="w3-bar-item w3-button">CHANGE ORDER</a>
      <a href="index.php#googleMap" class="w3-bar-item w3-button">CONTACT</a>
    </div>
  </div>

<form method="post" action="order_info.php">
<div class="row w3-container w3-padding-16 w3-red w3-greyscale-min w3-xlarge">
  <div class="column w3-red">
    <div class="w3-content" style="width: 100%">
      <h1 class="w3-center w3-jumbo" style="margin-bottom:64px;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred"><strong>Order Info</strong></h1>
        <table class="table w3-text-black w3-large">
        <tr style="font-family:verdana">
          <th>Menu</th>   
          <th>Kuantitas</th>
          <th>Harga Satuan</th>
          <th>Sub Total</th>
          <?php
            //print_r($pesanan_pizza);

            $_SESSION['pesanan_pizza'] = $pesanan_pizza;
            $_SESSION['pesanan_pasta'] = $pesanan_pasta;
            $_SESSION['pesanan_starter'] = $pesanan_starter;

            $idx = 0;
            foreach ($pesanan_pizza as $i) {
              if($i > 0) {
                echo "<tr style=\"font-family:verdana\">";
                echo "<td>" . $pizza_menus[$idx]["nama_menu"] . "</td>"; //. untuk concat
                echo "<td style=padding-left:3em>" . $i . "</td>";
                echo "<td>Rp " . $pizza_menus[$idx]["harga"] . "</td>";
                echo "<td>Rp " . $i * $pizza_menus[$idx]["harga"] . "</td>";
                // echo "<td class=\"w3-center\"><a href=\"#\"><img border=\"0\" src=\"images/closebtn.png\" width=\"22\" height=\"22\"></td>";
                $total += $i * $pizza_menus[$idx]["harga"];
                echo "</tr>";
              }
              $idx += 1;
            }

            $idx = 0; 
            foreach ($pesanan_pasta as $i) {
              if($i > 0) {
                echo "<tr style=\"font-family:verdana\">";
                echo "<td>" . $pasta_menus[$idx]["nama_menu"] . "</td>"; //. untuk concat
                echo "<td style=padding-left:3em>" . $i . "</td>";
                echo "<td>Rp " . $pasta_menus[$idx]["harga"] . "</td>";
                echo "<td>Rp " . $i * $pasta_menus[$idx]["harga"] . "</td>";
                $total += $i * $pasta_menus[$idx]["harga"];
                echo "</tr>";
              }
              $idx += 1;
            }

            $idx = 0;
            foreach ($pesanan_starter as $i) {
              if($i > 0) {
                echo "<tr style=\"font-family:verdana\">";
                echo "<td>" . $starter_menus[$idx]["nama_menu"] . "</td>"; //. untuk concat
                echo "<td style=padding-left:3em>" . $i . "</td>";
                echo "<td>Rp " . $starter_menus[$idx]["harga"] . "</td>";
                echo "<td>Rp " . $i * $starter_menus[$idx]["harga"] . "</td>";
                $total += $i * $starter_menus[$idx]["harga"];
                echo "</tr>";
              }
              $idx += 1;
            }
          ?>
        </tr>
      </table>
    <br>
    <?php echo "<strong style=\"font-family:verdana\" class=\"w3-xlarge\">Total harga :</strong> <strong style=\"font-family:verdana;padding-left:9em\" class=\"w3-xlarge w3-right\"> Rp " . $total . "</strong>" ?>
    </div>
  </div>

  <div class="column w3-red">
    <div class="w3-content" style="width: 100%">
        <h1 class="w3-center w3-jumbo" style="margin-bottom:64px;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred"><strong>Contact Info</strong></h1>
        <p class="w3-xxlarge"><strong>PENTING!</strong> Mohon isi data dibawah ini dengan lengkap agar pesanan anda dapat kami proses :</p>

        <b style="font-family: sans-serif;"><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="Name" maxlength="30" value=""></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Telephone Number" required name="Telp" maxlength="15" value=""></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="email" placeholder="Email" required name="Email" maxlength="30" value=""></p>
        <p><textarea class="w3-input w3-padding-16 w3-border" placeholder="Delivery Address" required name="Address" maxlength="100" value="" rows="3"></textarea></p></b>
        <input type="submit" class="w3-button w3-xxlarge w3-black" name="placeorder" value="ORDER NOW">
    </div>
  </div>
</div>
</form>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
  <p> Designed and Published by <font class="w3-hover-text-yellow" style=color:orange><strong>Project X</strong></font></p>
  <p style=color:red><font size="6"><span class="badge badge-warning">WARNING !!</span> Web ini dimaksudkan untuk penyelesaian tugas kuliah. Segala bentuk fitur dan jasa pada web ini hanya sebatas prototipe.</font></p>
</footer>

<!-- remove function -->
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(function(){
      $('table').on('click','tr a',function(e){
         e.preventDefault();
        $(this).parents('tr').remove();
      });
 });
</script> -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>