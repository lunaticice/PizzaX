<?php
  session_start();

if (isset($_POST['send'])) {
    define('BASE', 'BASE');

    $Name = trim($_POST['Name']);
    $Telp = trim($_POST['Telp']);
    $Email = trim($_POST['Email']);
    $People = trim($_POST['People']);
    $Date = trim($_POST['Date']);
    $Message = trim($_POST['Message']);


    $errors = array();
    if (strlen($Name) == 0)
      array_push($errors, "Nama harus diisi");
    if (strlen($Telp) == 0)
      array_push($errors, "Nomor Telepon harus diisi");
    if (strlen($Email) == 0)
      array_push($errors, "Email harus diisi");
    if ($People == 0)
      array_push($errors, "Jumlah Orang harus diisi");
    if (strlen($Date) == 0)
      array_push($errors, "Tanggal reservasi harus diisi");

    //jika error 0
    if (count($errors) == 0) {
      require_once("database/Database.php");

      $db = new RestoDB();
      if ($db->insert_reservasi($Name, $Telp, $Email, $People, $Date, $Message)) {
        header("Location: index.php");
        exit();
      }
      else
        array_push($erorrs, "Gagal reservasi, silahkan cek data anda.");
    }
  }
?>

<!DOCTYPE html>
<html>
<title>PizzaX</title>
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
    <strong>
      <a href="index.php" class="w3-bar-item w3-button">HOME</a>
      <a href="#menu" class="w3-bar-item w3-button">MENU</a>
      <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
      <a href="#googleMap" class="w3-bar-item w3-button">CONTACT</a>
      <a href="#reserve" class="w3-bar-item w3-button">RESERVE TABLE</a>
      <a href="login_admin.php" class="w3-bar-item w3-button w3-yellow w3-right">CHEF LOGIN</a>
    </strong>
  </div>
</div>
  
<!-- Header with image -->
<header class="bgimg w3-display-container" id="home">
  <div class="w3-display-bottomleft w3-padding">
    <span class="w3-tag w3-xlarge w3-animate-top">Open from 10am to 12pm</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white w3-hide-small w3-animate-opacity" style="font-size:120px;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue"><b>RESTAURANT<br>PIZZAX</b></span>
    <span class="w3-text-white w3-hide-large w3-hide-medium w3-animate-opacity" style="font-size:60px"><b>RESTAURANT<br>PIZZAX</b></span>
    <p><a href="#menu" class="w3-button w3-xxlarge w3-black w3-animate-top w3-hover-amber w3-hover-text-black">Let me see the menu</a></p>
  </div>
</header>

<!-- Menu Container -->
<div class="w3-container w3-black w3-padding-64 w3-xxlarge" id="menu">
  <div class="w3-content">
  
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred"><strong>THE MENU</strong></h1>
    <div class="w3-row w3-center w3-border w3-border-dark-grey">
      <a href="javascript:void(0)" onclick="openMenu(event, 'Pizza');" id="myLink">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Pizza</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Pasta');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Pasta</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Starter');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Starter</div>
      </a>
    </div>

    <form name="order_form" method="post" action="order_info.php">
      <?php
          define('BASE', 'BASE');
          require_once("database/Database.php");

          $db = new RestoDB();

          $pizza_menus = $db->select_menu_pizza();
          $pasta_menus = $db->select_menu_pasta();
          $starter_menus = $db->select_menu_starter();

          $_SESSION['pizza_menus'] = $pizza_menus;
          $_SESSION['pasta_menus'] = $pasta_menus;
          $_SESSION['starter_menus'] = $starter_menus;
          //print_r($menus);
      ?>
    <div id="Pizza" class="w3-container menu w3-padding-32 w3-white">
      <?php
        foreach ($pizza_menus as $pizza) {
          echo "<h1><b>" . $pizza["nama_menu"] . "</b> <span class=\"w3-right w3-tag w3-dark-grey w3-round\">Rp " . $pizza["harga"] . "</span></h1>";
          echo "<p class=\"w3-text-grey\">" . $pizza["keterangan_menu"];
          echo "<span class=\"w3-right w3-tag w3-white w3-round\"><b>Qty : </b><input type=\"number\" min=\"0\" name=\"qty" . $pizza["id_menu"] . "\" class=\"qtytext\"></span></p><hr>";
        }
        ?>
    </div>

    <div id="Pasta" class="w3-container menu w3-padding-32 w3-white">
      <?php
        foreach ($pasta_menus as $pasta) {
          echo "<h1><b>" . $pasta["nama_menu"] . "</b> <span class=\"w3-right w3-tag w3-dark-grey w3-round\">Rp " . $pasta["harga"] . "</span></h1>";
          echo "<p class=\"w3-text-grey\">" . $pasta["keterangan_menu"];
          echo "<span class=\"w3-right w3-tag w3-white w3-round\"><b>Qty : </b><input type=\"number\" min=\"0\" name=\"qty" . $pasta["id_menu"] . "\" class=\"qtytext\"></span></p><hr>";
        }
      ?>
    </div>


    <div id="Starter" class="w3-container menu w3-padding-32 w3-white">
      <?php
        foreach ($starter_menus as $starter) {
          echo "<h1><b>" . $starter["nama_menu"] . "</b> <span class=\"w3-right w3-tag w3-dark-grey w3-round\">Rp " . $starter["harga"] . "</span></h1>";
          echo "<p class=\"w3-text-grey\">" . $starter["keterangan_menu"];
          echo "<span class=\"w3-right w3-tag w3-white w3-round\"><b>Qty : </b><input type=\"number\" min=\"0\" name=\"qty" . $starter["id_menu"] . "\" class=\"qtytext\"></span></p><hr>";
        }
      ?>
    </div><br>
    <p><button class="w3-button w3-red w3-block" name="order" type="submit"><b>Order Now</b></button></p>
    </form>
  </div>
</div>

<!-- About Container -->
<div class="w3-container w3-padding-64 w3-deep-orange w3-xlarge" id="about">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:8px;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred"><strong>About</strong></h1>
    <div class="w3-row w3-padding-8">
        <p><strong>PizzaX</strong> are the Italian Restaurant based on Jakarta. We serve pizza, pasta, and starter dish. Customer could enjoy the dish at our restaurant or delivered to their home. We also approve reservation. </p>
    </div>
    <div class="w3-row w3-center">
        <img src="images/logo.png" style="width:30%" class="w3-margin-top" alt="Restaurant">
    </div>
    <p class="w3-xxlarge">Meet Our Chef:</p>
    <div class="w3-row w3-padding-16">
        <p><strong>Hengki Pranoto</strong> are the junior year student at Tarumanagara University. Currently majoring on Computer Science.
            <br>NIM : 535150015<img src="images/pasfoto.png" style="width:100px" class="w3-circle w3-right" alt="dev1"></p>
    </div>
    <div class="w3-row w3-padding-16">
        <p><strong>David Reynaldo</strong> are the junior year student at Tarumanagara University. Currently majoring on Computer Science.
            <br>NIM : 535150044 <img src="images/pasfoto2.jpg" style="width:100px" class="w3-circle w3-right" alt="dev2"></p>
    </div>
    <div class="w3-row w3-padding-16">
        <p><strong>Fonda Fernandi Hamid</strong> are the junior year student at Tarumanagara University. Currently majoring on Computer Science.
            <br>NIM : 535150032<img src="images/pasfoto3.jpg" style="width:100px" class="w3-circle w3-right" alt="dev3"></p>
    </div>
    <h1><b>Opening Hours</b></h1>
    
    <div class="w3-row">
      <div class="w3-col s6">
        <p>Mon & Tue CLOSED</p>
        <p>Wednesday 10.00 - 24.00</p>
        <p>Thursday 10:00 - 24:00</p>
      </div>
      <div class="w3-col s6">
        <p>Friday 10:00 - 12:00</p>
        <p>Saturday 10:00 - 23:00</p>
        <p>Sunday Closed</p>
      </div>
    </div>
    
  </div>
</div>


<!-- Contact (with google maps) -->
<div id="googleMap" style="width:100%;height:400px;"></div>

<div class="w3-container w3-padding-64 w3-blue w3-grayscale-min w3-xlarge">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px;text-shadow: 1px 1px 2px black, 0 0 25px red, 0 0 5px darkred"><strong>Contact</strong></h1>
    <p>Find us on the map above or call us at 021-5566-7777</p>
    <p><span class="w3-tag">FYI!</span> We understand your needs and we will cater the food to satisfy the biggest criteria of them all, both look and taste.</p>
    <p class="w3-xxlarge" id="reserve"><strong>Reserve</strong> a table online here !</p>
    <form name="reserve_form" method="post">
      <b><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="Name" maxlength="30"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Telephone Number" required name="Telp" maxlength="15"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="email" placeholder="Email" required name="Email" maxlength="30"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="How many people" min="1" max="8" required name="People" maxlength="2"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="date" placeholder="Date and time" required name="Date" value="2017-11-16T20:00"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message  Special requirements" name="Message" maxlength="50"></p>
      <p><button class="w3-button w3-dark-grey w3-block w3-xlarge" type="submit" name="send" value=""><strong>SEND MESSAGE</strong></button></p></b>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
  <p>Designed and Published by <font class="w3-hover-text-yellow" style=color:orange><strong>Project X</strong></font></p>
  <p style=color:red><font size="6"><span class="badge badge-warning">WARNING !!</span> Web ini dimaksudkan untuk penyelesaian tugas kuliah. Segala bentuk fitur dan jasa pada web ini hanya sebatas prototipe.</font></p>
</footer>

<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(-6.169205, 106.789151);
  var mapOptions= {
    center:myCenter,
    zoom:14, scrollwheel: false, draggable: true,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}

// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-red";
}

document.getElementById("myLink").click();
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl0XmOZEmEpVuXtgF_XqV3UNMss5n1yH4&callback=myMap"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>
