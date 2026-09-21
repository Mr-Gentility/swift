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
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);
	
$user=$_SESSION['cod_name'];
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $L_['accounting']; ?></title>
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

				</div>
				<!-- / main header -->
				<div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
					<!-- service -->
					<div class="panel hbox hbox-auto-xs no-border">
						<div class="col-md-12">
							<div class="card-box table-responsive">
								<div align="center">
									  <tr>
										<td>
											<?php 
												$Debit_card=0;$Effective=0;$Credit_card=0;$Transfer=0; $Paypal=0;
												$sql=mysql_query("SELECT * FROM accounting");
												while($row=mysql_fetch_array($sql)){
													if($row['book_mode']=='Effective'){
														$entrada=$entrada+$row['shipping_subtotal'];
													}elseif($row['book_mode']=='Debit_card'){
														$salida=$salida+$row['shipping_subtotal'];
													}elseif($row['book_mode']=='Credit_card'){
														$credit=$credit+$row['shipping_subtotal'];
													}elseif($row['book_mode']=='Transfer'){
														$transfers=$transfers+$row['shipping_subtotal'];
													}elseif($row['book_mode']=='Paypal'){
														$pay=$pay+$row['shipping_subtotal'];
													}
												}

											?>
											</br></br>
											<table class="table">
												<tr>
													<td>
														 <?php if(isset($_SESSION['user_name']) && $_SESSION['user_type'] == 'Administrator') { ?>
														  <!-- stats -->
															  <div class="row row-sm text-center">
																<div class="col-xs-3">
																  <div class="panel padder-v item">
																	<div class="h1 text-success font-thin h1">
																	<?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup">
																	<?php echo $s.formato($entrada); ?></span></div>	
																	<span class="text-muted text-xs"><?php echo $L_['efective']; ?></span>
																	<div class="top text-right w-full">	
																	  <i class="icon-wallet text-success m-r-sm"></i>				  
																	</div>
																  </div>
																</div>
																<div class="col-xs-3">
																  <a href="#" class="block panel padder-v bg-primary item">
																	<span class="text-white font-thin h1 block">
																	<?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup">
																	<?php echo $s.formato($salida); ?></span></span>
																	<span class="text-muted text-xs"><?php echo $L_['debit_card']; ?></span>
																	<span class="bottom text-right w-full">
																	  <i class="icon-credit-card text-muted m-r-sm"></i>
																	</span>
																  </a>
																</div>
																<div class="col-xs-3">
																  <a href class="block panel padder-v bg-info item">
																	<span class="text-white font-thin h1 block">
																	<?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup">
																	<?php echo $s.formato($credit); ?></span></span>
																	<span class="text-muted text-xs"><?php echo $L_['credit_card']; ?></span>
																	<span class="top">
																	  <i class="icon-credit-card text-warning m-l-sm m-r-sm"></i>
																	</span>
																  </a>
																</div>
																<div class="col-xs-3 m-b-md">
																  <div class="r bg-light dker item hbox no-border">
																	<div class="col dk padder-v r-r">
																	  <div class="text-primary-dk font-thin h1"><span>
																	  <?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup">
																	  <?php echo $s.formato($transfers); ?></span></div>
																	  <span class="text-muted text-xs"><?php echo $L_['transfer']; ?></span>
																		<span class="bottom text-right w-full">
																	  <i class="icon-share-alt text-muted m-r-sm"></i>
																	</span>																	  
																	</div>
																  </div>
																</div>
															  </div>											
														  <!-- / stats -->
														 <?php } ?>
													</td>
												</tr>
												
											</table>
											<?php 
												if(!empty($_GET['fechai']) AND !empty($_GET['fechaf'])){
													$fechai=limpiar($_GET['fechai']);
													$fechaf=limpiar($_GET['fechaf']);
												}else{
													$fechai=date('Y-m-d');	
													$fechaf=date('Y-m-d');	
												}
												$locker=''; $user='';	$trans='';		$where='';
												$act_trans='active';$act_usu='';
												if(!empty($_GET['trans'])){
													$trans=limpiar($_GET['trans']);
													$act_trans='active';
													$act_usu='';
													if($trans<>'all'){
														$where="WHERE book_mode='".$trans."' AND book_date between '$fechai' AND '$fechaf'"; 
													}else{
														$where='';	
													}
												}elseif(!empty($_GET['locker'])){
													$locker=limpiar($_GET['locker']);
													$act_usu='active';
													$act_trans='';	
													$where="WHERE locker='".$locker."' AND book_date between '$fechai' AND '$fechaf'";
												}
												
											?>
											
											<div class="tabbable">
												<ul class="nav nav-tabs">
													<li class="<?php echo $act_trans; ?>"><a href="#tab1" data-toggle="tab"><strong><?php echo $L_['type_trans']; ?></strong></a></li>
													<li class="<?php echo $act_usu; ?>"><a href="#tab2" data-toggle="tab"><strong><?php echo $L_['type_client']; ?></strong></a></li>
												</ul>
												</br></br>
												<div class="tab-content" style="padding-bottom: 0px; border-bottom: 1px solid #ddd;">
													<div class="tab-pane <?php echo $act_trans; ?>" id="tab1">							
														<table border="0" align="center">
															<form name="form1" action="" method="get" class="form-inline">		
																<tr>				
																	<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rangofecha; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" class="accounting" name="fechai" value="<?php echo $fechai; ?>" autocomplete="off" required ></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $A; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" class="accounting" name="fechaf" value="<?php echo $fechaf; ?>" autocomplete="off" required></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $L_['type_transaction']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td>
																		<select class="accounting" name="trans">
																			<option value="all" <?php if($trans=='all'){ echo 'selected'; } ?>><?php echo $L_['type_all']; ?></option>
																			<option value="Effective" <?php if($trans=='Effective'){ echo 'selected'; } ?>><?php echo $L_['type_effective']; ?></option>
																			<option value="Debit_card" <?php if($trans=='Debit_card'){ echo 'selected'; } ?>><?php echo $L_['type_debit']; ?></option>
																			<option value="Credit_card" <?php if($trans=='Credit_card'){ echo 'selected'; } ?>><?php echo $L_['type_credit']; ?></option>
																			<option value="Transfer" <?php if($trans=='Transfer'){ echo 'selected'; } ?>><?php echo $L_['type_transfers']; ?></option>
																			<option value="Paypal" <?php if($trans=='Paypal'){ echo 'selected'; } ?>>PAYPAL</option>
																		</select>
																	</td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><button type="submit" class="btn btn-md btn-danger"><i class="icon-search"></i> <strong><?php echo $L_['type_consult']; ?></strong></button></td>
																</tr>
															</form>
														</table>
													</div>
													
													<div class="tab-pane <?php echo $act_usu; ?>" id="tab2">
														<table border="0" align="center">
															<form name="form2" action="" method="get" class="form-inline">		
																<tr>				
																	<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rangofecha; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" class="accounting" name="fechai" value="<?php echo $fechai; ?>" autocomplete="off" required ></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $A; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" class="accounting" name="fechaf" value="<?php echo $fechaf; ?>" autocomplete="off" required></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $L_['type_clients']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td>
																		<select class="accounting" name="locker">
																			<?php 
																				$sql=mysql_query("SELECT * FROM tbl_clients ORDER BY name");
																				while($row=mysql_fetch_array($sql)){
																					if($row['locker']==$locker){
																						echo '<option value="'.$row['locker'].'" selected>'.$row['name'].'</option>';
																					}else{
																						echo '<option value="'.$row['locker'].'">'.$row['name'].'</option>';
																					}
																				}
																			?>
																		</select>
																	</td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><button type="submit" class="btn btn-md btn-danger"><i class="icon-search"></i> <strong><?php echo $L_['type_consult']; ?></strong></button></td>
																</tr>
															</form>															
														</table>														
													</div>
												</div>
											</div>
											</br></br>
											<table ui-jq="dataTable" class="table table-striped b-t b-b">
												<thead>
													<tr>
														<td><strong>ID</strong></td>
														<td><strong>TRACKING</strong></td>
														<td><strong><?php echo $L_['name_client']; ?></strong></td>
														<td><strong><center><?php echo $L_['name_book_mode']; ?></center></strong></td>
														<td><strong><center><?php echo $L_['name_date']; ?></center></strong></td>
														<td><strong><center><?php echo $L_['name_value']; ?></center></strong></td>
														<td><strong><center><?php echo $L_['name_employ']; ?></center></strong></td>
													</tr>
												</thead>
												<tbody>
												<?php 
													$initial = 0; // Empezar a contar desde 0
													$result=mysql_query("SELECT * FROM accounting ".$where);
													while($row=mysql_fetch_array($result)){
														if($row['book_mode']=='Effective'){
															$book_mode='<span class="label label-success">'.$L_['type_effective'].'</span>';
														}elseif($row['book_mode']=='Debit_card'){
															$book_mode='<span class="label label-default">'.$L_['type_debit'].'</span>';
														}elseif($row['book_mode']=='Credit_card'){
															$book_mode='<span class="label label-danger">'.$L_['type_credit'].'</span>';
														}elseif($row['book_mode']=='Transfer'){
															$book_mode='<span class="label label-warning">'.$L_['type_transfers'].'</span>';
														}elseif($row['book_mode']=='Paypal'){
															$book_mode='<span class="label label-info">PAYPAL</span>';
														}
														
														$initial = $initial + $row['shipping_subtotal'];
														
												?>
												<tr>
													<td><?php echo $row['cid'] ?></td>
													<td><?php echo $row['tracking'] ?></td>
													<td><?php echo $row['ship_name']; ?></td>
													<td><center><?php echo $book_mode; ?></center></td>
													<td><center><?php echo $row['book_date']; ?></center></td>
													<td><center><?php echo $s.' '.formato($row['shipping_subtotal']); ?></center></td>
													<td><center><?php echo $row['office']; ?></center></td>
												</tr>
												<?php } ?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="5" style="text-align: right;" rowspan="1">
															<b><?php echo $L_['name_sales']; ?></b>
														</td>
														<td style="text-align: center;" rowspan="1" colspan="1">
															<b><?php echo $_SESSION['ge_curr']; ?> <?php echo $initial; ?></b>
														</td>
													</tr>
												</tfoot>
											</table>
										</td>
									  </tr>
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
<script type="text/javascript">
            function cambiarcont(pagina) {
                       $("#contenido").load(pagina);
            }
</script>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="js/delivery.js"></script>


</body>
</html>
