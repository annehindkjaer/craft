
<?php
require_once 'dbconst.php';
session_start();
$sessionids = '';
$ordrecount = 0;
if(isset($_SESSION["ordre"])){
foreach($_SESSION["ordre"] as $key => $val)
{
$ordrecount = $ordrecount + $val;
}
}else{
$ordrecount = 0;
}
/** 
VIS KURV START
**/
//lav variabel
$ordrecount = 0;
//tjek om session "items" eksisterer
if(isset($_SESSION["ordre"])){
//tæller alle produkter i session "items" og giv antallet til variabel
foreach($_SESSION["ordre"] as $key => $val)
{
$ordrecount = $ordrecount + $val;
}
}else {
//hvis der ikke findes nogen session "items", så er der ikke blevet tilføjet nogle produkter endnu
$ordrecount = 0;
}
/** 
VIS KURV SLUT
**/
?>
<?php
//deletes product if GET parameter is set
if(isset($_GET['produktid'])){
$deleteproduktid = $_GET['produktid'];
unset($_SESSION['ordre'][$deleteproduktid]);
}
//checks if itemsarray contains products
if(isset($_SESSION['ordre']) && $_SESSION['ordre'] != true){
// echo 'array findes ikke';
unset($_SESSION['ordre']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Kurv</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<!--
Template 2076 Zentro
http://www.tooplate.com/view/2076-zentro
-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/nivo-lightbox.css">
<link rel="stylesheet" href="css/nivo_themes/default/default.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/kurv.css">
<link href="https://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- preloader section -->
<section class="preloader">
<div class="sk-spinner sk-spinner-pulse"></div>
</section>
<!-- navigation section -->
<section class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="icon icon-bar"></span>
<span class="icon icon-bar"></span>
<span class="icon icon-bar"></span>
</button>
<!--<a href="#" class="navbar-brand">ZENTRO</a>-->
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<!--<li><a href="#home" class="smoothScroll">HOME</a></li>-->
<li class="menulinje"><a href="#menu" class="smoothScroll">ABOUT</a></li>
<li class="menulinje"><a href="#process" class="smoothScroll">PROCESS</a></li>
<li><a href="forside.php"><img src="images/hlogo.png" alt="Smiley face" height="90" width="90"></a></li>
<li class="menulinje"><a href="#team" class="smoothScroll">WEBSHOP</a></li>
<li class="menulinje"><a href="#contact" class="smoothScroll">ORDER</a></li>
<li class="menulinje"><a href="kurv.php"> <img src="images/indkobskurv.png" alt="Smykkestativ" height="30" width="30"></a>antal:
<?php echo $ordrecount; ?></li>
</ul>
</div>
</div>
</section>
<section>
<?php 
if(isset($_SESSION["ordre"])){
foreach($_SESSION["ordre"] as $key => $val)
{
$sessionids .= $key . ',';
}
//trimming
$sessionids = rtrim($sessionids, ',');
echo "her er" . $sessionids;
$sql = 'select * from produkt where p_id in (' . $sessionids . ')';
//connect to datbase
$result = $link->query($sql);
$totalpris = 0;
while($row = $result->fetch_array()) {
$p_id = $row['p_id'];
$produktantal = $_SESSION["ordre"][$p_id];
$totalproduktpris = $row['pris']*$produktantal;
$totalpris += $totalproduktpris;
?>
<div class="produktordre">
<div id="pnavn"><h1><?= $row['p_navn']; ?></h1></div>
<div id="img"><img src='<?= $row['images']; ?>' width="200" height="200"></div>
<div id="pris"><p><b>Pris: </b><?= $row['pris']; ?></p></div>
<div id="pbeskriv"><p><b>Produkt beskrivelse:</b><br> <?= $row['p_beskrivelse']; ?></p></div>
<div id="antal"><p><br><b>Antal:</b> <?= $produktantal; ?></p></div>
<div id="slet"><button><a href="<?= $_SERVER['PHP_SELF'] ?>?produktid=<?= $p_id;?>">X</a></button></div>
</div>
<?php
}
}else {echo 'ingen session';}
?>
<div class="totalpris">
<h2> <?= $totalpris?>kr</h2>
<button><a href="kassen.php">Gå til kassen</button></a>
</div>
</section>
<!-- JAVASCRIPT JS FILES --> 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>