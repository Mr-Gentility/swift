<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('dashboard/funciones.php');

$styling = mysql_fetch_array(mysql_query("SELECT * FROM styles"));
$cons_no = isset($_POST['shipping_online']) ? $_POST['shipping_online'] : '';

$sql = "SELECT c.cid, c.cons_no, c.book_mode, c.countries AS current_city, c.countries, c.paisdestino, c.type, c.service, c.deliverydate, c.weight, c.comments, c.ship_name, c.s_phone, c.s_add, c.rev_name, 
c.r_phone, c.r_add, c.date, c.user, s.color, c.status FROM courier_online c, service_mode s WHERE s.servicemode = c.status AND c.cons_no = '$cons_no'";
																														
$result = dbQuery($sql);
$no = dbNumRows($result);
if($no == 1){	
				
while($data = dbFetchAssoc($result)) {
extract($data);

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track My Parcel  | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V3.2.2"/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>

	<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="deprixa/asset1/css/font-awesome.min.css" type="text/css" media="screen">  
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />   
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />
	<link href="deprixa/css/style.css" rel="stylesheet" media="all">
	
	<!-- Style Status -->
	<style><?php echo $styling['style']; ?></style>
	
</head>

   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->

<div class="slide"></div>
<main class="slide">
    <div class="fw">
		<section class="title">
			<header>
				<h1><img src="dashboard/img/tracking-search.png" />Parcel Tracking Online</h1>					                   
			</header>
			<div class="media-left">
				
			</div>
		</section>
    </div>  

<div class="container">

<div class="row">
	<table border="0" align="center" width="100%">
		<div class="row">
			<div class="col-md-4">     
				<h3>
				<center>
						<img src="deprixa_components/images/barcode.png" /></br>
						<font color="#000"><?php echo $cons_no; ?></font>
				</center>				
				</h3>    
			</div>
			<div class="col-md-8">
				 <h3><font  color="Black" face="arial,verdana"><strong>Current state</strong></font>:&nbsp;<span style="background: #<?php echo $color; ?>;"  class="label label-large" ><font size=2 color="White" face="arial,verdana"><?php echo $status; ?></font></span>&nbsp;&nbsp;&nbsp;
				  <font  color="Black" face="arial,verdana"><strong>Mode of payment</strong></font>:&nbsp;<span class="label label-danger"><i class="fa fa-euro"></i><font size=2 color="White" face="arial,verdana"> <?php echo $book_mode; ?></font></span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</h3>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-4"> <font size=3 color="Black" face="arial,verdana"><strong>Delivery schedule</strong></font><br />
			<?php echo $deliverydate; ?>, End of the day
			</div>
			<div class="col-md-4"> <font size=3 color="Black" face="arial,verdana"><strong>Last location</strong></font><br />
				<div> <?php echo $current_city ?> - &nbsp;<?php echo $paisdestino ?></div>
			</div>
		</div>
		<hr />
		<div class="row">
		  <div class="col-md-12">
			<h2>Additional information</h2>
		  </div>
		  <br/>
			<div class="col-md-4"> <font size=2 color="Black" face="arial,verdana"><strong>Origin:</strong></font> <?php echo $countries; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Destination:</strong></font> <?php echo $paisdestino; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Service mode:</strong></font> <?php echo $service; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Type service:</strong></font> <?php echo $type; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Weight:</strong></font> <?php echo $weight; ?>&nbsp;kg<br />
				<font size=2 color="Black" face="arial,verdana"><strong>Collection date and time:</strong></font> <?php echo $date; ?><br/>   
				<font size=2 color="Black" face="arial,verdana"><strong>Shipping description:</strong></font> <?php echo $comments; ?>
			</div>
			<div class="col-md-4"> <font size=3 color="Black" face="arial,verdana"><strong>Details of the sender</strong></font><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Name:</strong></font> <?php echo $ship_name; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Phone:</strong></font> <?php echo $s_phone; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Address:</strong></font>  <?php echo $s_add; ?> 
			</div>
			<div class="col-md-4"> <font size=3 color="Black" face="arial,verdana"><strong>Information from the recipient</strong></font><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Name:</strong></font> <?php echo $rev_name; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Phone:</strong></font> <?php echo $r_phone; ?><br />
				<font size=2 color="Black" face="arial,verdana"><strong>Address:</strong></font>  <?php echo $r_add; ?>
			</div>				
		</div>
		<hr />
		<div class="row">
			<div class="col-md-12">
				<h2>Shipping history</h2>
				<br/>
					<?php
						require_once('dashboard/database.php');

						//EJECUTAMOS LA CONSULTA DE BUSQUEDA
						$result = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
						//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
						echo ' <table class="table table-bordered table-striped table-hover" >
									<tr class="car_bold col_dark_bold" align="center">
										<td><font color="Black" face="arial,verdana"><strong>Tracking No</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>New Location</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>State shipping</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>Date and time</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>Remarks</strong></font></td>																							
									</tr>';
						if(mysql_num_rows($result)>0){
							while($row = mysql_fetch_array($result)){
								echo '<tr align="center">
										<td>'.$row['letra'].'-'.$row['cons_no'].'</td>
										<td>'.$row['pick_time'].'</td>
										<td>'.$row['status'].'</td>
										<td>'.$row['bk_time'].'</td>				
										<td>'.$row['comments'].'</td>
										</tr>';
							}
						}else{
							echo '<tr>
										<td colspan="5" >There are no results</td>
									</tr>';
						}
						echo '</table>';
					?>
			</div>
		</div> 
	</table>										
 <!-- End Deprixa Section -->	

</div>

 </main>

   <!-- Footer -->
   
 <?php include_once "footer.php"; ?>
 
    <!-- /Footer -->


    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/Scripts/tracking.js"></script>
</body>
</html>
<script>
   window.onload=load;
   window.onunload=GUnload;
</script>
<?php 

}//while

}//if
else {
echo '';
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track My Parcel  | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V3.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />   
	<link href="deprixa/css/style.css" rel="stylesheet" media="all">

</head>

   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->
	
<div class="slide">    
    </div>
        <main class="slide">
        <div class="fw">
            <section class="title">
                <header>
                    <h1><img src="dashboard/img/tracking-search.png" />Parcel Tracking</h1>					                   
                </header>
				<div class="media-left">
                    
                    </div>
            </section>
        </div>  
		<div class="container">
				<div class="page-content">					
					
					<div class="text-center">
						<h1><img src="dashboard/img/no_courier.png" /></h1>
						<h3>Tracking number not found,</h3>
						<p><font color="#FF0000"><?php echo $cons_no; ?></font> check the number or Contact Us.</p>
						<div class="text-center"><a href="index.php" class="btn-system btn-small">Back To Home</a></div>
					</div>					
				</div>
		</div>
		</div>
		<!-- End Content -->

   <!-- Footer -->
   
 <?php include_once "footer.php"; ?>
 
    <!-- /Footer -->
    </div>

    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/bundles/modernizr"></script>
    <script src="deprixa_components/scripts/tracking.js"></script>

</body>
</html>
<?php 
}//else
?>
