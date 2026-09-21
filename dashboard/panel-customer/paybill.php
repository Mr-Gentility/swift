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
require_once('../database.php');
require_once('../library.php');
require_once('../funciones.php');
require '../requirelanguage.php';

date_default_timezone_set($_SESSION['ge_timezone']);
$qname = $_SESSION['user_name']; 
 
$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles")); 
isUser(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $payinvoice; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>

  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />
  <script type= "text/javascript" src="../../process/countries.js"></script> 
	
  <!-- Style Status -->
  <style><?php echo $styling['style']; ?></style>

</head>
<body>
<?php
include("header.php");
?>
  
 <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <h1 class="m-n font-thin h3 text-black"><?php echo $dashboard; ?></h1>
          <small class="text-muted"><?php echo $bienvenidosa; ?> <?php echo $_SESSION['ge_cname']; ?></small>
        </div>        
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

      <!-- service -->
      <div class="panel hbox hbox-auto-xs no-border">
        <div class="col wrapper">
          <i class="fa fa-circle-o text-info m-r-sm pull-right"></i>
          <h3 class="font-thin m-t-none m-b-none text-primary-lt"><?php echo $PAYINVOICE; ?></h3>
          <span class="m-b block text-sm text-muted"></span>

			  <tr>
			  <td class="TrackTitle" valign="top"><div  align=""><h3 class="classic-title1"><span><strong></strong></span></h3>
			</tr>
			</div>
			<div class="table-responsive">
			<br>
			  <table ui-jq="dataTable" class="table table-striped b-t b-b">
				<thead>
				  <tr>
					  <th></th>
					  <th><?php echo $PAYING; ?></th>
					  <th></th>
					  <th> <?php echo $tracking; ?></th>
					  <th><?php echo $PAISORIGEN; ?></th>
					  <th><?php echo $PAISDESTINO; ?> </th>
					  <th><?php echo $DATEEN; ?> </th>
					  <th> <?php echo $SUBTOTAL; ?></th>						  
					  <th> <?php echo $PAGOS; ?></th>
					  <th> <?php echo $NAMECLIENT; ?></th>
					  <th><?php echo $STATUSEN; ?></th>
				  </tr>
				</thead>
				<tbody>
					<?php  					
						$result3 = mysql_query("SELECT c.cid, c.cons_no,c.ship_name, c.ciudad, c.city1, c.deliverydate, c.office, c.email, c.paymode, c.payment, c.shipping_subtotal, 
						s.color,s.servicemode, c.status FROM courier_online c, service_mode s   
							WHERE  s.servicemode = c.status AND email='$qname' AND c.status != 'delivered' ORDER BY c.cid DESC");
						while($row = mysql_fetch_array($result3)) {					
					?>
				  <tr>				  
					  <td align="center">					
					  <a target="_blank" href="../print-invoice/customer-invoice-print.php?cid=<?php echo codificar($row ['cid']); ?>">
					  <i class="glyphicon glyphicon-print icon text-dark-lter"></a></td>
					  <td align="center">
						<form action="payments.php?shipping_subtotal=<?php echo $row['shipping_subtotal']; ?>" method="post">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="image" src="img/checkout-with-paypal.png" border="0" name="submit" width="104" height="29">
						</form>
					  </td>
					  <td><a href="#myModal<?php echo $row ['cid']; ?>" data-toggle="modal">
					  <img src="img/bank-tranfers.png" height="30" width="50"></a></td>
					  <td><font color="#000"><?php echo $row ['cons_no']; ?></font></td>
					  <td><?php echo $row ['ciudad']; ?></td>
					  <td><?php echo $row ['city1']; ?></td>
					  <td><?php echo $row ['deliverydate']; ?></td>	
					  <td><?php echo $company['currency']; ?>&nbsp;<?php echo $row ['shipping_subtotal']; ?></td>									  
					  <td align="center"><span class="label <?php echo $row['payment']; ?> label-large"><?php echo $row['payment']; ?></span></td>
					   <td><?php echo $row ['ship_name']; ?></td>
					  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>									 
				  </tr>
				  
				  <!-- sample modal content -->
					<div id="myModal<?php echo $row['cid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title" id="myModalLabel"><?php echo $DETAILBANK; ?></h4>
									<br>
									<hr>
									<h5><?php echo $REALIZAPAY; ?></h5></br>
									<?php echo $namebank; ?>: <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['ge_smtp']; ?></strong></br>
									<?php echo $nameaccoung; ?>: <strong><?php echo $_SESSION['ge_smtphost']; ?></strong> </br>
									<?php echo $numberaccoung; ?>: <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['ge_smtpuser']; ?></strong></p>
									<hr>
								</div>
								<div class="modal-body">
									<h4 class="header-title m-t-0 m-b-20"><?php echo $sendpay; ?></h4>
									<br>								
									<div class="text-xs-center">
									
										<div class="p-10">
											<div class="form-group clearfix">
												<form action="config.inc.php?action=update-bank&cid=<?php echo $row['cid']; ?>" enctype="multipart/form-data" method="post">
												<fieldset class="form-group">
												
													<div class="form-group">
														<label for="address" class="col-sm-2 control-label"><?php echo $numbersend; ?></label>
														<div class="col-sm-5">
														  <input type="text"  name="cons_no" class="form-control cons_no" value="<?php echo $row['cons_no']; ?>" readonly="true">
														</div>
														<div class="col-sm-5">
														  <input class="form-control office" name="office" value="<?php echo $_SESSION['user_name'] ;?>" readonly="true">																  
														</div>
													</div>
													
												</fieldset>
												<label for="zipcode" class="control-label"><i class="fa fa-upload icon text-default-lter"></i>&nbsp;<?php echo $uploadfile; ?></label>
												<input type="file" name="imagen" id="imagen" class="form-control" />
												<br><br>
												<div class="alert alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<?php echo $filepermitidos; ?>
												</div>
												<div class="modal-footer">
												<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo $CERRAR; ?></button>
												<button type="submit" name="guardar" class="btn btn-info-outline waves-effect waves-light"><?php echo $UPLOADFILE; ?></button>
												</div>
												<br><br>
												</form>
											</div>
										</div>
										<br>									
									</div>
								</div>
									
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				  <?php } ?>
				</tbody>				
			  </table>
			</div>

		  </div>
		</div>       
      </div>
      <!-- / service -->
    </div>
  </div>
  <!-- / main -->
</div>
			
</div>
  <!-- / content -->

  <!-- footer -->
  <?php
include("../footer.php");
?>
  <!-- / footer -->

</div>

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../js/ui-load.js"></script>
<script src="../js/ui-jp.config.js"></script>
<script src="../js/ui-jp.js"></script>
<script src="../js/ui-nav.js"></script>
<script src="../js/ui-toggle.js"></script>

</body>
</html>
