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
  <h1 class="m-n font-thin h3"><?php echo $L_['settingapi']; ?></h1>
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
									<div class="col-xs-6 col-sm-6 col-md-6" style="float: none; margin: 0 auto;">
										<div class="alert alert-dismissible alert-<?php echo $_GET ['tipo'] ?>">
											<button type="button" class="close" data-dismiss="alert">x</button>
											<strong><?php echo $L_['message']; ?></strong><br/><br/> <?php echo $_GET ['mensaje']; ?>
										</div>
									</div>
								</div>
								<?php } ?>

								<h3 class="classic-title"><span><strong><i class="fa fa-cog icon text-danger-lter"></i>&nbsp;&nbsp;<?php echo $L_['settingapi']; ?></strong></h3>
						
									<!-- API NEXMO -->
													
											<?php		
												$result = mysql_query("SELECT * FROM api_sms WHERE  id='1' ");
												while($rr = mysql_fetch_array($result)) {								
												?>	

													<form action="settings/api_sms/api_settings.php"  method="post"  class="form-horizontal" > 
														<!-- API KEY NEXMO -->
														<fieldset class="col-md-6">								
														
															<legend><?php echo $L_['apisms']; ?></legend>
															
															<!-- API KEY -->								
															<div class="row">
																<div class="col-sm-6 form-group">
																	<label for="zipcode" class="control-label"><?php echo $L_['apikeys']; ?></label>
																	<input type="text" class="form-control" value="<?php echo $rr['apikey']; ?>"  name="apikey">
																</div>
																<!-- API SECRET -->
																
																<div class="col-sm-6 form-group">
																	<label for="zipcode" class="control-label"><i class="fa fa-hashtag icon text-default-lter"></i>&nbsp;<?php echo $L_['apisecrets']; ?></label>
																	<input type="text" class="form-control" value="<?php echo $rr['apisecret']; ?>"  name="apisecret">
																</div>																								
															</div>
															<br><br>
															<div class="row">
																<div class="col-sm-12 form-group">
																	<img src="img/nexmo.png" width="87">
																		<?php echo $L_['singup']; ?></br></br>
																		link:  
																		<a href="https://dashboard.nexmo.com/sign-up" target="_blank"><font color="blue"><?php echo $L_['singupcredit']; ?></font></a>

																</div>
															</div>												
															<div class="col-md-6 text-left">
																<br><br><br><br>
																<button name="Submit" type="submit" class="btn btn-large btn-info"><?php echo $L_['updateapi']; ?></button>	
																<br><br><br><br>
															</div>
													</fieldset>
													</form>
													<?php } ?>	
												
												
													<?php		
													$result2 = mysql_query("SELECT * FROM api_sms WHERE  id='2' ");
													while($rr = mysql_fetch_array($result2)) {								
													?>		
													<div class="row">
														<form action="settings/api_sms/api_update.php"  method="POST"  class="form-horizontal" > 
															<!-- START Presonal information -->
															<fieldset class="col-md-6">								
															
																<legend><i class="fa fa-comment-o icon text-danger-lter"></i>&nbsp;&nbsp;<?php echo $L_['notificationsms']; ?>:</legend>
																</br>
																<p><strong><?php echo $L_['name_sms_courier']; ?></strong></p>
																<!-- sms courier -->								
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailsend']; ?>"  name="detailsend">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailinvoice']; ?>"  name="detailinvoice">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailprice']; ?>"  name="detailprice" >																			
																	</div>																	
																	<div class="col-sm-3 form-group">
																		<br>
																		<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>											
																	</div>
																</div>
															</fieldset>
														</form>
														<?php } ?>

												
														<?php		
														$result3 = mysql_query("SELECT * FROM api_sms WHERE  id='3' ");
														while($rr = mysql_fetch_array($result3)) {								
														?>		

														<form action="settings/api_sms/api_update2.php"  method="POST"  class="form-horizontal" > 
															<!-- START Presonal information -->
															<fieldset class="col-md-6">																							
																<!-- sms courier -->								
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailsend']; ?>"  name="detailsend">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailinvoice']; ?>"  name="detailinvoice">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailprice']; ?>"  name="detailprice" >																			
																	</div>																	
																	<div class="col-sm-3 form-group">
																		<br>
																		<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>											
																	</div>
																</div>
															</fieldset>
														</form>
														<?php } ?>
														
													
														<?php		
														$result3 = mysql_query("SELECT * FROM api_sms WHERE  id='4' ");
														while($rr = mysql_fetch_array($result3)) {								
														?>		

														<form action="settings/api_sms/api_update3.php"  method="POST"  class="form-horizontal" > 
															<!-- START Presonal information -->
															<fieldset class="col-md-6">	
																</br>
																<p><strong><?php echo $L_['name_sms_courier_online']; ?></strong></p>
																<!-- sms courier -->								
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailsend']; ?>"  name="detailsend">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailinvoice']; ?>"  name="detailinvoice">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailprice']; ?>"  name="detailprice" >																			
																	</div>																	
																	<div class="col-sm-3 form-group">
																		<br>
																		<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>											
																	</div>
																</div>
															</fieldset>
														</form>
														<?php } ?>
														
														<?php		
														$result3 = mysql_query("SELECT * FROM api_sms WHERE  id='5' ");
														while($rr = mysql_fetch_array($result3)) {								
														?>		

														<form action="settings/api_sms/api_update4.php"  method="POST"  class="form-horizontal" > 
															<!-- START Presonal information -->
															<fieldset class="col-md-6">	
																<!-- sms courier -->								
																<div class="row">
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailsend']; ?>"  name="detailsend">
																	</div>
																	<div class="col-sm-3 form-group">
																		<label for="zipcode" class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailinvoice']; ?>"  name="detailinvoice">
																	</div>
																	
																	<div class="col-sm-3 form-group">
																		<label class="control-label"></label>
																		<input type="text" class="form-control" value="<?php echo $rr['detailprice']; ?>"  name="detailprice" >																			
																	</div>																	
																	<div class="col-sm-3 form-group">
																		<br>
																		<button name="Submit" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>											
																	</div>
																</div>
															</fieldset>
														</form>
														<?php } ?>
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

</body>

</html>