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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$k_navn = filter_input(INPUT_POST, 'navn') or die('Error: Navn er ikke gyldigt');
$adresse = filter_input(INPUT_POST, 'adresse') or die('Error: adresse er ikke gyldigt');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) or die('Error: email er ikke gyldig');
$zip_zip = filter_input(INPUT_POST, 'zip_zip') or die('Error: postnr er ikke gyldigt');
echo 'bestilling er nu gennemført';
$sql = 'INSERT INTO kunde(k_navn, adresse, email, zip_zip) values (?,?,?,?)';
$stmt = $link->prepare($sql); 
$stmt->bind_param('sssi', $k_navn, $adresse, $email, $zip_zip);
$stmt->execute();
//få fat i id fra seneste oprettede bruger + generer en dato
$sqluser = "SELECT k_id FROM kunde order by k_id desc LIMIT 1";
$userid = "";
$result = mysqli_query($link, $sqluser);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
$userid = $row["k_id"];
}
} else {
echo "0 results";
}
//$id = last_insert_id();
$dato = date("Y/m/d");
//insert i ordre tabel
$sql = "INSERT INTO `ordre`(`dato`, `status_s_id`, `kunde_k_id`) VALUES (CURRENT_DATE(), 1, $userid)";
if ($link->query($sql) === TRUE) {
echo "New record created successfully";
}else {
echo "ikke indsat";
}
//select og få fat i nyeste ordre id
$sqlorder = "SELECT o_id FROM ordre order by o_id desc LIMIT 1";
$orderid = "";
$result = mysqli_query($link, $sqlorder);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
$orderid = $row["o_id"];
}
} else {
echo "0 results";
}
echo $orderid;
//allersidst indsæte flere gange i ordrelinje - det fra kurven - (lidt svær måske)
foreach ($_SESSION["ordre"] as $id => $antal)
{
$sqlinsert = "INSERT INTO `ordrelinje`(`antal`, `aktuelpris`, `ordre_o_id`, `ordre_status_s_id`, `produkt_p_id`) 
VALUES ($antal, 45, $orderid, 1, $id)";
if ($link->query($sqlinsert) === TRUE) {
echo "indsat produkter";
}else {
echo "ikke indsat";
}
}
}?>
<head>
<link rel="stylesheet" href="css/kassen.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'> 
<meta charset="UTF-8">
<title>Betaling</title>
</head>
<body>
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
<link rel="stylesheet" href="css/kassen.css">
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
<li class="menulinjekurv"><a href="kurv.php"> <img src="images/indkobskurv.png" alt="Smykkestativ" height="30" width="30"></a>antal:
<?php echo $ordrecount; ?></li>
</ul>
</div>
</div>
</section>
<br><br><br><br>
<header>INDTAST OPLYSNINGER
</header>
<div id="udfyldningsform"><form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="topBefore" name="checkoutform" id="checkoutform">
<input id="navn" name="navn" type="text" placeholder="NAVN">
<input id="adresse" name="adresse" type="text" placeholder="ADRESSE">
<input id="email" name="email" type="text" placeholder="E-MAIL">
<input id="zip_zip" name="zip_zip" type="text" placeholder="ZIP_ZIP">
<input id="submit" type="submit" value="GO!">
</form>
<div id="forsendelse">
<h3><img src="images/frifragt-01.png" width="30" height="30"> Få sendt fragtfrit ved køb over 400 kr.</h3> 
</div>
</div>
<div id="visordre">
<?php
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
if(isset($_SESSION["ordre"])){
foreach($_SESSION["ordre"] as $key => $val)
{
$sessionids .= $key . ',';
}
//trimming
$sessionids = rtrim($sessionids, ',');
//echo "her er " . $sessionids;
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
<div id="pnavn"><h2><?= $row['p_navn']; ?></h2></div>
<div id="pris"><p><b>Pris: </b><?= $row['pris']; ?></p></div>
<div id="antal"><p><br><b>Antal: <?= $produktantal; ?></b></p></div>
</div>
<?php
}
}else {echo 'ingen session';}
?>
<div class="produktordre">
<h2>I alt: <?= $totalpris?>kr</h2>
<img src="images/visakredit.png" height="60" width="250">
</div>
</div>
</section>
</body>
</html>