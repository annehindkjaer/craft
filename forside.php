	<?php
session_start();
require_once 'dbconst.php';
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
/**
START LÆG I KURV
**/
//tjek om GET parametre findes productid og qty (kan ses i URL)
if(isset($_GET['produktid']) && isset($_GET['qty'])){
//giv antal til variabel
$qty = $_GET['qty'];
//tjek om session er sat til produkt nr. 1
if(isset($_SESSION["ordre"][$_GET['produktid']])){
//hvis produkt 1 allerede eksisterer, så tilføj et produkt mere af det givne produkt til session
$_SESSION["ordre"][$_GET['produktid']] += $qty;
//(opdater kurv)
$ordrecount = 0;
foreach($_SESSION["ordre"] as $key => $val)
{
$ordrecount = $ordrecount + $val;
}
}else {
//hvis produkt 1 ikke findes, så opret produkt som session
$_SESSION["ordre"][$_GET['produktid']] = $qty;
//(opdater kurv)
$ordrecount = 0;
foreach($_SESSION["ordre"] as $key => $val)
{
$ordrecount = $ordrecount + $val;
}
}
}
/**
SLUT LÆG I KURV
**/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Handcrafted</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">

<!--STYLESHEETS-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/nivo-lightbox.css">
<link rel="stylesheet" href="css/nivo_themes/default/default.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=The+Girl+Next+Door" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">

<SCRIPT TYPE="text/javascript">
  function popup(mylink, windowname) { 
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string') href=mylink;
    else href=mylink.href; 
    window.open(href, windowname, 'width=400,height=200,scrollbars=yes'); 
    return false; 
  }
</SCRIPT>









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
<li class="menulinje"><a href="#webshop" class="smoothScroll">WEBSHOP</a></li>
<li class="menulinje"><a href="#contact" class="smoothScroll">COSTUMIZE</a></li>
<li class="menulinjekurv"><a href="kurv.php"> <img src="images/indkobskurv.png" alt="Smykkestativ" height="30" width="30"></a>antal: <?php echo $ordrecount; ?></li>
</ul>
</div>
</div>
</section>
<!-- home section -->
<section id="home" class="parallax-section">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12">
<h2 id="forside"> <b>HANDCRAFTED CPH</b></h2>

</div>
</div>
</div> 
</section>
<!-- menu section -->
<section id="menu" class="parallax-section">
<div class="container">
<div class="row">
<div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
<br><br><h1 class="about">ABOUT</h1>
<hr>
</div> <br><br><br><br><br>
<div id="textbox">
<h3>HANDCRAFTED</h3> <hr>
<p id="abouttext">HandcraftedCph is local, handmade jewellery shop in the streets of Copenhagen.
<br>
The brand is focused around simple, raw and well-thought designs – in sterling silver and gold. 
Earrings, rings, cuffs and simple bracelets – that are made to be worn, and will change and 
get a unique look as you use them. <br>
/HandcraftedCph</p><br>
<br>
</div>


<div id="aboutanders">
<h3>ANDERS FORUP</h3> <hr>
<p id="aboutanderstext">I am a 33 year old jeweler. I make handcrafted silver and gold necklaces, rings and bracelets based on my costumers wishes. <br><br>
 I focus on making the jewerly classic and timeless, and i dont want to be compared to jewelery companies who mass produce their jewelry. 
<br>
/HandcraftedCph</p><br> 
<br>
</div>

</div>
</div>
</section>
<!-- process section -->
<section id="process" class="parallax-section">
<div class="container">
<div class="row">

<h1 class="processoverskrift">PROCESS</h1>
<hr>
<br><br><br>
<div class="boksud">


<div id="boks1"> <h3>DESIGN</h3><p>
<img  id="billeder" src="images/design.png" alt="handcrafted vintage" height="100" width="100">
<br><p class="tekst">
&bull; Design of the jewerly<br>
&bull; Corospondance<br>
&bull; Final sketch aproved<br>
</p>
</div>


<div id="boks2"> <h3>DEVELOPE</h3> <p>
<img  id="billeder" src="images/develope.png" alt="handcrafted vintage" height="100" width="100">
<br><p class="tekst">
&bull; Molding process<br>
&bull; Filing the jewely<br>
&bull; Polishing and decorate<br>
</p></div>


<div id="boks3"> <h3>DEPLOY</h3><p>
<img  id="billeder" src="images/send.png" alt="handcrafted vintage" height="100" width="100">
<br><p class="tekst">
&bull; Jewerly done<br>
&bull; Send to costumer<br>
&bull; Recieve<br>
</p></div>


</div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</section>


<!-- team section -->

<!-- process section -->
<section id="webshop" >
<div class="container">
<div class="row">
<div class="webshops">
<h1 class="heading">WEBSHOP</h1>
<hr>
<br><br>
<?php
require_once 'dbconst.php';

$sql = 'select p_id, images, p_navn, p_beskrivelse, pris, storrelse from produkt';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($pid, $pimage, $name, $description, $price, $storrelse);
while($stmt->fetch()) {
?>
    
 
    <!-- Modal -->
    
<div id="myModal<?= $pid; ?>" class="modal fade" role="dialog"> <!--dette er knappen som åbner smykket-->
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $name;?></h4>
      </div>
      <div class="modal-body">
        <p>Produkt nr <?= $pid;?> vises nu <?= $description; ?>  
        <select name="storrelse">
              <option value="50"> 50 </option>
              <option value="51"> 51 </option>
              <option value="52"> 52 </option>
              <option value="53"> 53 </option>
          </select> 
          
         <select name="farve">
              <option value="guld">guld</option>
              <option value="soelv">sølv</option>
         </select>
          </p>

<p>pris: <?= $price;?></p>
<!-- tilføj til kurv knap -->
<a href="<?= $_SERVER['PHP_SELF'] ?>?produktid=<?= $pid;?>&qty=1"><h4>Læg i kurv</h4> <img src="images/indkobskurv.png" alt="produkt" width="30" height="30"></i></a>
</div>



      </div>
     </div>
    </div>


<!--</div>-->

<div class="productbox"><img src="<?= $pimage; ?>" data-toggle="modal" data-target="#myModal<?= $pid; ?>"></div>
<?php
}
?>

</div>
</div>
</div>
</section>


<!-- order section -->
<section id="contact" class="parallax-section">
<div class="container">
<div class="row">
<div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
<h1 class="heading">COSTUMIZE</h1>
<hr>
</div>
<br><br><br>
<?php


require_once 'dbconst.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){



$b_navn = filter_input(INPUT_POST, 'navn') or die('Error: Navn er ikke gyldigt');
$b_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) or die('Error: email er ikke gyldig');
$b_size = filter_input(INPUT_POST, 'b_size') or die('Error: størrelse er ikke gyldigt');
$b_beskriv = filter_input(INPUT_POST, 'beskriv') or die('Error: beskrivelse er ikke gyldigt');
$b_farve = filter_input(INPUT_POST, 'farve') or die('Error: farve er ikke gyldigt');
$b_img = filter_input(INPUT_POST, 'b_img') or die('Error: billede er ikke gyldigt');


$sql = 'INSERT INTO bestil(b_navn, b_email, b_size, b_beskriv, b_farve, b_img) values (?,?,?,?,?,?)';




	$stmt = $link->prepare($sql); 
	$stmt->bind_param('ssisss', $b_navn, $b_email, $b_size, $b_beskriv, $b_farve, $b_img);
	$stmt->execute();


  
}

?>	
<div id="baggrundbestil"> 
<div id="kontakt-form">
<br><br><br><br><br><br><br><br><br><br>

<form action="<?= $_SERVER['PHP_SELF']; ?>"  method="post" class="topBefore" name="checkoutform" id="checkoutform">

		 <div id="navn">NAME<input  id="bnavn" name="navn" type="text"></div> 
         <br><br>
         <div id="email">EMAIL<input id="bemail" name="email" type="text">
         <br><br>
 <div id="beskriv">DESCRIBE<textarea id="bbeskriv" name="message" rows="3" cols="5" required></textarea> 
       <br><br>
         
        
      <div id="sizess">  <select name="storrelse" id="sizes">
              <option  value="S">Small</option>
              <option value="M">Medium</option>
              <option value="M">Large</option>
          </select>   </div>
        
          
      <div id="colorss">   <select name="farve" id="colors">
              <option  value="guld">Gold</option>
              <option value="soelv">Silver</option>
              <option value="soelv">Plated silver</option>
          </select> </div>
          
               <br>
               
               <label class="fileContainer">
    Click here to upload your picture
    <input name="b_img" type="file"/>
</label>
               
 
          <br>
        
     
<input id="submit" type="submit" value="SEND!"></input> 
  

  
</form>
<br><br><br>
</div>
</div>
</div>
</div>



	
</section>


<!-- footer section -->
<center><footer class="parallax-section">
<div class="container">
<div class="row">

<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
<h2 class="heading">Open Hours</h2>
<p>WED-FRI <span>11 - 17</span></p>
<p>SAT<span>11 - 15</span></p>
</div>

<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
<h2 class="heading">Contact Info.</h2>
<div class="ph">
<p><i class="fa fa-phone"></i> Phone</p>
<h4>22 43 30 06</h4>
</div>
<div class="address">
<p><i class="fa fa-map-marker"></i> Our Location</p>
<h5> SHOP - SØNDER BOULEVARD 59</h5>
</div>
</div>

<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
<h2 class="heading">Follow Us</h2>
<ul class="social-icon">
<li><a href="https://www.facebook.com/Handcraftedcph" class="fa fa-facebook wow bounceIn" data-wow-delay="0.3s"></a></li>
<li><a href="https://www.instagram.com/handcraftedcph/" class="fa fa-instagram wow bounceIn" data-wow-delay="0.6s"></a></li>

</ul>
</div>
</div>
</div>
</footer></center>

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