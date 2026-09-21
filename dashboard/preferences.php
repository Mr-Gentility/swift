<?php 
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system		                               *
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
require_once('database.php');
require_once('library.php');
require 'requirelanguage.php';

$qname = $_SESSION['user_name']; 	
$qrole = $_SESSION['user_type']; 

isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $configure; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

</head>
<body>
 <?php include("header.php"); ?> 
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
     
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3"><?php echo $CONFIGURE; ?></h1>
</div>
<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12">
      <div class="blog-post">                   
        <div class="panel">
          <div>           
          </div>
			<div class="wrapper-lg">           
				<div>
					<table border="0" align="center" width="100%">
						<tbody>
							<tr>
							<?php	if ( isset ( $_GET ['tipo'] ) ) {	?>					
							<div class="row" >
								<div class="col-xs-12 col-sm-12 col-md-12" style="float: none; margin: 0 auto;">
									<div class="alert alert-dismissible alert-<?php echo $_GET ['tipo'] ?>">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong><?php echo $L_['message']; ?></strong><br/><br/> <?php echo $_GET ['mensaje']; ?>
									</div>
								</div>
							</div>
							<?php } ?>

							<h3 class="classic-title"><span><strong><i class="icon-wrench icon text-warning-lter"></i>&nbsp;&nbsp;<?php echo $configure; ?></strong></h3>
						
							<!-- START Checkout form -->
													
								<?php		
									$result4 = mysql_query("SELECT * FROM company WHERE  id='1' ");
									while($rr = mysql_fetch_array($result4)) {								
									?>	
									
								<div class="row">
									<form action="settings/company/settings.php"  method="POST"  class="form-horizontal" > 
										<!-- START Presonal information -->
										<fieldset class="col-md-6">								
										
											<legend><?php echo $DETAILCOMPANIES; ?>:</legend>
											
											<!-- Country and state -->								
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><?php echo $NAMECOMPANIES; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['cname']; ?>"  name="cname">
												</div>
												<div class="col-sm-3 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa-hashtag icon text-default-lter"></i>&nbsp;<?php echo $NIT; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['nit']; ?>"  name="nit">
												</div>
												
												<div class="col-sm-3 form-group">
													<label class="control-label"><i class="fa fa-phone-square icon text-default-lter"></i>&nbsp;<?php echo $PHONECOM; ?></label>
													<input type="text" class="form-control" value="<?php echo $rr['cphone']; ?>"  name="cphone" >
														
												</div>									
											</div>
											<!-- Qnty -->
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa-at icon text-default-lter"></i>&nbsp;<?php echo $EMAILNOTI; ?></label> 
													<input type="email" class="form-control" value="<?php echo $rr['bemail']; ?>"  name="bemail">
												</div>
												
											<!-- Origin Office -->
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa fa-edge icon text-default-lter"></i>&nbsp;<?php echo $website; ?></label>
													<input value="<?php echo $rr['website']; ?>"  placeholder="http://www.example.com" name="website" class="form-control" >																				
												</div>	
											</div>												
											 <!-- Payment Mode -->
											 <div class="row">
												
											</div>
											<div class="row">
												<!-- Text area -->
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-map-marker icon text-default-lter"></i>&nbsp;<?php echo $companydir; ?></label>
													<textarea class="form-control" name="caddress" > <?php echo $rr['caddress']; ?></textarea>
												</div>
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><i class="fa fa fa-edge icon text-default-lter"></i>&nbsp;<?php echo $footerweb; ?></label>
													<input value="<?php echo $rr['footer_website']; ?>"  placeholder="" name="footer_website" class="form-control" >																				
												</div>
											</div>
											<div class="row">
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa  fa fa-map icon text-default-lter"></i>&nbsp;<?php echo $paisorigen; ?></label>
													<input class="form-control" name="country" value="<?php echo $rr['country']; ?>">
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa fa-map-o icon text-default-lter"></i>&nbsp;<?php echo $cciudad; ?></label>
													<input class="form-control" name="city" value="<?php echo $rr['city']; ?>">
												</div>															
												<!-- Destination Office -->															
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-usd icon text-default-lter"></i>&nbsp;<?php echo $moneda; ?></label>
													<select class="form-control" name="currency" value="<?php echo $rr['currency']; ?>">
														<option value="AUD" <?php if($_SESSION['ge_curr']=='AUD'){ echo 'selected'; } ?>>Australian dollar (A $)</option>
														<option value="CAD" <?php if($_SESSION['ge_curr']=='CAD'){ echo 'selected'; } ?>>Canadian dollar (C $)</option>
														<option value="EUR" <?php if($_SESSION['ge_curr']=='EUR'){ echo 'selected'; } ?>>Euro (€)</option>
														<option value="GBP" <?php if($_SESSION['ge_curr']=='GBP'){ echo 'selected'; } ?>>Pound sterling (£)</option>
														<option value="JPY" <?php if($_SESSION['ge_curr']=='JPY'){ echo 'selected'; } ?>>Japanese yen (¥)</option>
														<option value="USD" <?php if($_SESSION['ge_curr']=='USD'){ echo 'selected'; } ?>>US dollar ($)</option>
														<option value="PESO" <?php if($_SESSION['ge_curr']=='PESO'){ echo 'selected'; } ?>>Colombia peso ($)</option>
														<option value="NZD" <?php if($_SESSION['ge_curr']=='NZD'){ echo 'selected'; } ?>>New Zealand dollar ($)</option>
														<option value="CHF" <?php if($_SESSION['ge_curr']=='CHF'){ echo 'selected'; } ?>>Swiss franc</option>
														<option value="HKD" <?php if($_SESSION['ge_curr']=='HKD'){ echo 'selected'; } ?>>Dollar of Hong Kong ($)</option>
														<option value="SGD" <?php if($_SESSION['ge_curr']=='SGD'){ echo 'selected'; } ?>>Singapore dollar ($)</option>
														<option value="SEK" <?php if($_SESSION['ge_curr']=='SEK'){ echo 'selected'; } ?>>Swedish krona</option>
														<option value="DKK" <?php if($_SESSION['ge_curr']=='DKK'){ echo 'selected'; } ?>>Danish krone</option>
														<option value="PLN" <?php if($_SESSION['ge_curr']=='PLN'){ echo 'selected'; } ?>>Polish Zloty</option>
														<option value="NOK" <?php if($_SESSION['ge_curr']=='NOK'){ echo 'selected'; } ?>>Norwegian krone</option>
														<option value="HUF" <?php if($_SESSION['ge_curr']=='HUF'){ echo 'selected'; } ?>>Hungarian forint</option>
														<option value="CZK" <?php if($_SESSION['ge_curr']=='CZK'){ echo 'selected'; } ?>>Czech koruna</option>
														<option value="ILS" <?php if($_SESSION['ge_curr']=='ILS'){ echo 'selected'; } ?>>Israeli new shekel</option>
														<option value="MXN" <?php if($_SESSION['ge_curr']=='MXN'){ echo 'selected'; } ?>>Mexican peso</option>
														<option value="BRL" <?php if($_SESSION['ge_curr']=='BRL'){ echo 'selected'; } ?>>Brazilian real</option>
														<option value="MYR" <?php if($_SESSION['ge_curr']=='MYR'){ echo 'selected'; } ?>>Malaysian Ringgit</option>
														<option value="PHP" <?php if($_SESSION['ge_curr']=='PHP'){ echo 'selected'; } ?>>Philippine peso</option>
														<option value="TWD" <?php if($_SESSION['ge_curr']=='TWD'){ echo 'selected'; } ?>>New Taiwan dollar</option>
														<option value="THB" <?php if($_SESSION['ge_curr']=='THB'){ echo 'selected'; } ?>>Thai baht</option>
														<option value="PRUEBE" <?php if($_SESSION['ge_curr']=='PRUEBE'){ echo 'selected'; } ?>>Turkish Lira</option>
														<option value="RUB" <?php if($_SESSION['ge_curr']=='RUB'){ echo 'selected'; } ?>>Russian rouble</option>
													</select>	
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa  fa-random icon text-default-lter"></i>&nbsp;<?php echo $L_['units']; ?></label>
													<select class="form-control" name="measure" value="<?php echo $rr['measure']; ?>">
														<option value="Lb" <?php if($_SESSION['ge_measure']=='Lb'){ echo 'selected'; } ?>>Lb</option>
														<option value="Kg" <?php if($_SESSION['ge_measure']=='Kg'){ echo 'selected'; } ?>>Kg</option>
													</select>	
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-sort-alpha-asc icon text-default-lter"></i>&nbsp;<?php echo $prefix; ?></label>
													<input class="form-control" name="prefijo" value="<?php echo $rr['prefijo']; ?>">
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa  fa-sort-numeric-asc icon text-default-lter"></i>&nbsp;<?php echo $L_['consfix']; ?></label>
													<input class="form-control" name="cons_no" value="<?php echo $rr['cons_no']; ?>">
												</div>
												<div class="col-sm-3 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $datereg; ?></label>
													<input type="text" class="form-control" name="date" value="<?php echo $rr['date']; ?>" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
												</div>													
											</div>
											<div class="row">
												<!-- Text area -->
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><?php echo $metad; ?></label>
													<textarea class="form-control" name="description" > <?php echo $rr['description']; ?></textarea>
												</div>
												<div class="col-sm-6 form-group">
													<label for="zipcode" class="control-label"><?php echo $metakey; ?></label>
													<textarea class="form-control" name="keywords"> <?php echo $rr['keywords']; ?></textarea>																				
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6 form-group">
													<label for="lan"><i class="fa fa-language icon text-danger-lter" aria-hidden="true"></i>&nbsp;<?php echo $language; ?></label>
													<select class="form-control" name="lang" >
														<option value="en"  <?php if($_SESSION['ge_lang']=='en'){ echo 'selected'; } ?>><?php echo $english; ?></option>
														<option value="fr"  <?php if($_SESSION['ge_lang']=='fr'){ echo 'selected'; } ?>><?php echo $french; ?></option>
														<option value="hindi"  <?php if($_SESSION['ge_lang']=='hindi'){ echo 'selected'; } ?>><?php echo $hindi; ?></option>
														<option value="es"  <?php if($_SESSION['ge_lang']=='es'){ echo 'selected'; } ?>><?php echo $spanish; ?></option>
													</select>
												</div>
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $timezone; ?></label>
													<input type="text" class="form-control" name="timezone" value="<?php echo $rr['timezone']; ?>"  id="datepicker-autoclose">
												</div>
											</div>
											<div class="col-md-6 text-left">
												<br>
												<br>
												<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATEINFO; ?></button>											
											</div>
	
										</fieldset>
										<!-- START Email configuration  -->									
									
											<fieldset class="col-md-6">
											<legend><?php echo $DETAILBANK; ?></legend>
												<div class="row">	
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-bank (alias) icon text-default-lter"></i>&nbsp;<?php echo $namebank; ?></label>
														<input class="form-control" name="nom_banco" value="<?php echo $rr['nom_banco']; ?>">
													</div>
													<div class="col-sm-4 form-group"> 
														<label for="inputTextarea" class="control-label"><i class="fa fa-sort-numeric-desc icon text-default-lter"></i>&nbsp;<?php echo $nameaccoung; ?></label>
														<input class="form-control" name="nom_cuenta" value="<?php echo $rr['nom_cuenta']; ?>">
													</div>
													<div class="col-sm-4 form-group">
														<label for="inputTextarea" class="control-label"><i class="fa fa-hdd-o icon text-default-lter"></i>&nbsp;<?php echo $numberaccoung; ?></label>
														<input class="form-control" name="nro_cuenta" value="<?php echo $rr['nro_cuenta']; ?>">
													</div>																												
												</div>																									
											</fieldset>
											<fieldset class="col-md-6">
											<legend><?php echo $detailpaypal; ?></legend>
												<div class="row">																									
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-paypal icon text-default-lter"></i>&nbsp;<?php echo $emailpaypal; ?><span class="required-field">*</span></label>
														<input type="email" class="form-control" value="<?php echo $rr['cemail']; ?>"  name="cemail">																				
													</div>															
												</div>																									
											</fieldset>
											<fieldset class="col-md-6">
											<legend><?php echo $L_['locker']; ?></legend>
												<div class="row">																									
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-inbox icon text-default-lter"></i>&nbsp;<?php echo $L_['locker_virtual']; ?></label>
														<textarea class="form-control" name="locker"> <?php echo $rr['locker']; ?></textarea>																				
													</div>	
													<div class="col-sm-6 form-group">
														<label for="zipcode" class="control-label"><i class="fa fa-location-arrow icon text-default-lter"></i>&nbsp;<?php echo $L_['locker_dir']; ?></label>
														<textarea class="form-control" name="dirlocker"> <?php echo $rr['dirlocker']; ?></textarea>																				
													</div>
												</div>																									
											</fieldset>	
											<?php } ?>	
									</form>
									<div style="line-height:80px;padding:0;margin:0">&nbsp;</div>
									
										<!-- START Receiver info  -->
										<fieldset class="col-md-6">
										<br>
											<legend><?php echo $logosettings; ?></legend>
											<div class="row">
												<?php
													//conexion a la base de datos
													error_reporting(E_ERROR | E_WARNING | E_PARSE);
													require_once('database.php');


													//le dimos click al boton grabar?
													if (isset($_POST['guardar']))
													{
													$nombre = $_FILES['imagen']['name'];
													$imagen_temporal = $_FILES['imagen']['tmp_name'];
													$type = $_FILES['imagen']['type'];
													//archivo temporal en binario
													$itmp = fopen($imagen_temporal, 'r+b');
													$imagen = fread($itmp, filesize($imagen_temporal));
													fclose($itmp);
													//escapando los caracteres
													$imagen = mysql_real_escape_string($imagen);$respuesta = mysql_query("UPDATE subir_imagen SET nombre_imagen='$nombre',imagen='$imagen',tipo='$type'", $dbConn);
													//redireccionamos
													echo "<script type=\"text/javascript\">
															alert(\"The logo was updated correctly.\");
															window.location = \"preferences.php\"
														</script>";	
													}
													//guardado OK
													if (isset($_GET['ok']))
													{
													echo '<p>Saved successfully</p>';}
													//si no se guardo de manera correcta?
													if (isset($_GET['error']))
													{
													echo '<p>Occurred an error when it comes to the inclusion...</p>';}

													//formulario que nos permite subir a la BD el archivo
													echo '													
													<form action="preferences.php" enctype="multipart/form-data" method="post">
														<div class="col-sm-6 form-group">
														 <label for="zipcode" class="control-label"><i class="fa fa-upload icon text-default-lter"></i>&nbsp;'.$UPDATELOGOS.'</label>
														 <input type="file" name="imagen" id="imagen" class="form-control" />
														<br><br>
														 <button type="submit" name="guardar" class="btn btn-large btn-info">'.$UPDATELOGOS.'</button>
														<br><br>													
														</div>
													</form>';
													
												?>
											</div>
												<br><br>
											<div class="row">									
												<div class="col-sm-6 form-group">
													<label for="currentPassword"><strong><?php echo $logopresent; ?></strong></label></br></br>
													<img src="logo-image/image_logo.php?id=1"/>												
												</div>											
											</div>
											
										</fieldset>
								</div>	
						</tbody>
					</table>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
 <!-- / content -->	

<?php
include("footer.php");
?>

</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.custom-select').fancySelect(); // Custom select
		$('[data-toggle="tooltip"]').tooltip() // Tooltip
	});
</script>
<script type="text/javascript">
$(function alertaBox()
{
	$("div.alertaCaja").slideDown("fast");
	setTimeout(function(){
		window.history.replaceState( {} , '', document.URL.split('?')[0] );
		$("div.alertaCaja").slideUp("fast");
	}, 18000);
});
</script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
</body>

</html>