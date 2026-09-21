<?php
error_reporting(E_ERROR | E_PARSE);
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('pagination-search-result.php');

?>

<html>
<head>
    <title>Parcel Prices | Deprixa </title>
	<meta name="description" content="Courier Deprixa V3.2.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
	<script src="deprixa_components/hub/js/jquery.min.js"></script>
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script> 
	<script src="deprixa_components/hub/scripts/jquery-validate.min.js"></script>
	<script src="deprixa_components/hub/scripts/jquery-validate-unobtrusive.min.js"></script>	

	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
	
	<link rel="stylesheet" href="deprixa_components/hub/css/about-us.css" />	
	<link rel="stylesheet" href="deprixa_components/hub/css/royal-mail-comparison.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/services.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/bootstrap-mpd.css" />	
	<link rel="stylesheet" href="deprixa_components/hub/css/global.css" />
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/> 
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />



</head>
   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->
	
<div class="slide">   
</div>
<main class="slide">
<div class="fw royalMail main-promo">

</div>

<div class="fw ">
	<section class="cheaper-royal-mail">
		<div class="col-lg-6 col-md-7">
			<header>
				<h2><font color="Orange">Scheduled Pickup</font></h2>
			</header>
			<p><?php
			require_once('dashboard/database.php');
			//Get values
			$scountry = $_POST['scountry'];
			$sstate = $_POST['sstate'];
			$dcountry = $_POST['dcountry'];
			$dstate = $_POST['dstate'];
			$height = $_POST['height'];
			$length = $_POST['length'];
			$width = $_POST['width'];
			$volumetric = $_POST['volumetric'];

			// Using google distance matrix API to calculate distance between selected counrty
			$url = 'http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$sstate.'|'.$scountry.'&destinations='.$dstate.'|'.$dcountry.'&sensor=false';


			//replace empy spaces
			$target=str_replace(" ","",$url);
			$json = file_get_contents($target); 
			// get the data from Google Maps API
			$result = json_decode($json, true); 

			//Get Rate values from database
			$result = mysql_query("SELECT * FROM shipping_charge WHERE id ='1'");
			$row = mysql_fetch_array($result);


			//Send back in JSON Formate

			$output='<font size=4 color="Black" face="arial,verdana">SHIPPING FROM:</font> <font size=3 color="Green" face="arial,verdana">'.$_POST['sstate'].'&nbsp;-&nbsp;'.$_POST['scountry'].'</font><br><font size=4 color="Black" face="arial,verdana">SHIPPING TO</font>: &nbsp;&nbsp;&nbsp;&nbsp;<font size=3 color="Green" face="arial,verdana">'.$_POST['dstate'].'&nbsp;-&nbsp;'.$_POST['dcountry'].'</font> <br><br><font size=2 color="Black" face="arial,verdana">HEIGHT:</font> <font size=2 color="Green">'.$_POST['height'].'</font>&nbsp;|&nbsp;
			<font size=2 color="Black" face="arial">LENGTH:</font> <font size=2 color="Green" face="arial">'.$_POST['length'].'</font> &nbsp;|&nbsp; <font size=2 color="Black" face="arial">WIDTH:</font> <font size=2 color="Green" face="arial">'.$_POST['width'].'</font></br></br> 
			<font size=3 color="Black" face="arial">TOTAL VOLUMETRIC WEIGHT:</font> <font size=3 color="red" face="arial">'.$_POST['volumetric'].'</font>';

			echo $output;

			?></p>
		</div>
		<div class="col-lg-6 col-md-5"><img src="deprixa_components/images/parcelboy.png" alt=""></div>
	</section>
</div>

 
<div class="fw grey-bg">
	<section class="comparison-tables"><header>

	</header>
		<div class="table-container">

			<table class="responsive-table">
				<thead>
					<tr>
						<th scope="col" class="firstCol">Courier</th>
						<th scope="col" class="secondCol">More Info</th>
						<th scope="col">Services</th>
						<th class="noBorderRight" scope="col">Weight</th>
						<th class="noBorderRight" scope="col">Kilo Cost 1</th>
						<th class="noBorderRight" scope="col">Kilo Cost 2</th>
						<th class="noBorderRight" scope="col">Total kilos</th>
						<th scope="col">Your Rate</th>
					</tr>
				</thead>
				<?php
					$records = getPageData();
					if(count($records) > 0){
					$i = 0;
					foreach($records as $record){
					extract($record);	// extract array
					$i++; 				// increment i
					$even = $i%2; 		// getting MOD
				?>
				<?php 
				require_once('dashboard/database.php');

				$consulta=mysql_query("select * from scheduledpickup WHERE cid='$cid'");
				while($filas=mysql_fetch_array($consulta)){
					$ruta=$filas['courier'];


				?>
				<tbody>
				<tr><th scope="row"><img src="dashboard/logo-image/imagen-schedule-courier.php?cid=<?php echo $cid; ?>" class="img-full" height="35" width="80" alt="..."></th>
				<?php }?>
				<td data-title="Weight" data-type="currency">
				<a href="#" style="cursor:pointer; padding:5px; color:#666;">
				<i class="epi-print" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Printer Required"><img src="deprixa_components/images/printer.png" border="0" height="26" width="30"></i></a>
				<a style="cursor:pointer; padding:5px; color:#666;">
				<i href="#" class="epi-lock-open-alt-1" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Basic Cover Up To $100"><img src="deprixa_components/images/look.png" border="0" height="26" width="30"></i></a>
				<a style="cursor:pointer; padding:5px; color:#666;">
				<i href="#" class="epi-truck" style="font-size:28px;" data-toggle="tooltip" data-placement="top" title="Estimated 1 working day(s)"><img src="deprixa_components/images/truck.png" border="0" height="26" width="30"></i></a>

				</td>
				<td data-title="Royal Mail" data-type="currency">
				</a><?php echo $services; ?></td>
				<td data-title="Weight" data-type="currency">Kg&nbsp;<?php echo $Weight; ?></td>
				<td data-title="What You Save" data-type="currency"><span class="mpdGreen">$&nbsp;<?php echo $rate1; ?></span></td>
				<td data-title="What You Save" data-type="currency"><span class="mpdGreen">$&nbsp;<?php echo $rate2; ?></span></td>
				<td data-title="What You Save" data-type="currency"><span class="mpdred"><strong>$&nbsp;<?php echo $rate1*$Weight; ?></strong></span></td>
				<td><a href="login.php"><span><input  type="button" class="btn btn-primary btn-md" value="Book Now"  tabindex="-1" /></span></a></td>
				</tr>
				</tbody>
				<?php
					}//foreach
						}//if
					else {
						echo "<p><strong>Records Not Available.</strong></p>";
					}
				?>
			</table>
		</div>
	</section>
	</div>
</main>

    <!-- Footer -->
 <?php include_once "footer.php"; ?>
    <!-- /Footer -->
	</div>
	<script src="deprixa_components/hub/scripts/services/services.js"></script>
	<script src="deprixa_components/hub/scripts/placeholder-shim.js"></script>
	<script src="deprixa_components/hub/scripts/PostcodeValidation.js"></script>		
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	 <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-70616092-1', 'auto');
ga('send', 'pageview');
</script>		
</body>
</html>
