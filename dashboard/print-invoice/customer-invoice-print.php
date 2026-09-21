<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
require_once('../funciones.php');
require_once('../library.php');
require_once('../requirelanguage.php');

$cid= $_GET['cid'];
$cid = decodificar($cid);
$sql = "SELECT *
		FROM courier_online
		WHERE cid = $cid";	
$result = dbQuery($sql);		
while($row = dbFetchAssoc($result)) {
extract($row);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $facturacliente; ?></title>
	
	<!-- Define Charset -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Page Description and Author -->
	<meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
	<meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
    <meta name="author" content="Jaomweb">	
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/print-invoice.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="barcode.js"></script>
  </head>
  <body onload="window.print();">
    <div class="wrapper">

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
			  <span><img src="../logo-image/image_logo.php?id=1" width="150" height="39" ></span>
              <small class="pull-right"><?php  setlocale(LC_ALL,"en_EN");
					echo strftime("%A %d de %B del %Y");  ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            <?php echo $REMITE; ?>
            <address>
              <h4><strong><?php echo $ship_name; ?></strong></h4><br>

               <b><?php echo $telefono; ?>:</b>  <?php echo $s_phone; ?><br/>
              <b><?php echo $direccion; ?>:</b> <?php echo $s_add; ?><br/>
			  <b><?php echo $paisorigen; ?>:</b> <?php echo $countries; ?><br/>
			  <b><?php echo $ciudadorigen; ?>:</b> <?php echo $ciudad; ?><br/>
			  <b><?php echo $idcliente; ?>:</b> <?php echo $shippercc; ?><br/>
			  <b><?php echo $L_['lockerid']; ?>:</b>&nbsp;&nbsp;<?php echo $locker; ?>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <?php echo $DESTINA; ?>
            <address>
              <h4><strong><?php echo $rev_name; ?></strong></h4><br>
              
              <b><?php echo $telefono1; ?>:</b> <?php echo $r_phone; ?><br/>
			  <b><?php echo $telefono2; ?>:</b> <?php echo $r_phone1; ?><br/>
			  <b><?php echo $direccion1; ?>:</b> <?php echo $r_add; ?><br/>
			  <b><?php echo $email1; ?>:</b> <?php echo $receiveremail; ?><br/>
              <b><?php echo $paisdestino1; ?>:</b> <?php echo $paisdestino; ?><br/>
			  <b><?php echo $ciudaddestino; ?>:</b> <?php echo $city1; ?><br/>
			  <b><?php echo $idcliente1; ?>:</b> <?php echo $receivercc_r; ?><br/>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
		  <table>
				<tr>
					<td>
						<center>
							<?php	

								require_once('../database-settings.php');
								require_once('../funciones.php');
								require("barcode/barcode.class.invoice.php");
								$bar = new BARCODE();
								$db = conexion();	
								$cid= $_GET['cid'];
								$cid = decodificar($cid);
								$sql="SELECT cid,cons_no FROM courier_online WHERE cid=$cid";
								$query=$db->query($sql); 
								if($query->num_rows>0){
									while($row=$query->fetch_array()){
										$etrack = $row['cons_no'];
										$image = $bar->BarCode_link("CODE39", "$etrack");
										echo '<img src="'.$image.'">';
									}
								}
							?>						

						</center>
					</td>
					
				</tr>
			</table>
			<br/>           
            <b><?php echo $pesoenvio; ?>:</b>&nbsp;<?php echo $weight; ?>&nbsp; <?php echo $_SESSION['ge_measure']; ?><br/>
			<b><?php echo $metodopago; ?>:</b> <small class="label label-danger"><i class="fa fa-money"></i>&nbsp;&nbsp;<?php echo $bookingmode; ?></small><br/> 
			<b><?php echo $seguroenvio; ?>:</b>&nbsp;<?php echo $_SESSION['ge_curr']; ?>&nbsp;<?php echo $declarate; ?><br/>
			<b><?php echo $ordenestado; ?>: <span class="label bg-success"><?php echo $status; ?></span><br>
          </div><!-- /.col -->		 
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><?php echo $CANTIDAD; ?></th>
				  <th><?php echo $KG; ?>&nbsp;<?php echo $_SESSION['ge_measure']; ?></th>
				  <th><?php echo $ID; ?></th>
				  <th><?php echo $DESCRIPCION; ?></th>
				   <th><?php echo $PRECIO; ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $Qnty; ?></td>
				   <td><?php echo $_SESSION['ge_curr']; ?>&nbsp;<?php echo $variable; ?></td>
				  <td><?php echo $cons_no; ?></td>
				  <td><?php echo $note; ?></td>
				  <td><?php echo $_SESSION['ge_curr']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>										  
                </tr>               
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
		<br>
		<br>
        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead"><?php echo $metodospagos; ?>:</p>
            <img src="../img/credit/securepayment.png" alt="Methods payments" />           
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              <?php echo $sucomodidad; ?>
            </p>
          </div><!-- /.col -->
          <div class="col-xs-6">
            <p class="lead"><?php echo $monto; ?></p>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%"><?php echo $subtotal; ?>:</th>
                  <td><?php echo $_SESSION['ge_curr']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>
                </tr>
                <tr>
                  <th><?php echo $total; ?>:</th>
                  <td><?php echo $_SESSION['ge_curr']; ?>&nbsp;<?php echo $shipping_subtotal; ?></td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="js/app.min.js" type="text/javascript"></script>
  </body>
</html>
