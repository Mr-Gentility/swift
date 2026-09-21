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

require_once('funciones.php');
require_once('database-settings.php');
$db = conexion();

$action = isset($_GET['action']) ? $_GET['action'] : '';

function verify_users($user,$pwd,$estado) {	
	global $db;
	require 'requirelanguage.php';
		
	# para datos generales, mejor utilizo variables de sesion, asi no hago consultas a cada rato en la base
	$qryCompany = $db->query("SELECT timezone,cname,cphone,cemail,caddress,description,keywords,footer_website,lang,measure,currency,prefijo,nom_banco,nom_cuenta,nro_cuenta FROM company");
	$cInfo = $qryCompany->fetch_array();
	$_SESSION['ge_timezone'] = $cInfo['timezone'];
	$_SESSION['ge_cname'] = $cInfo['cname'];
	$_SESSION['ge_description'] = $cInfo['description'];
	$_SESSION['ge_keywords'] = $cInfo['keywords'];
	$_SESSION['ge_footer'] = $cInfo['footer_website'];
	$_SESSION['ge_curr'] = $cInfo['currency'];
	$_SESSION['ge_prefix'] = $cInfo['prefijo'];
	$_SESSION['ge_cphone'] = $cInfo['cphone'];
	$_SESSION['ge_cemail'] = $cInfo['cemail'];
	$_SESSION['ge_caddress'] = $cInfo['caddress'];
	$_SESSION['ge_lang'] = $cInfo['lang'];
	$_SESSION['ge_measure'] = $cInfo['measure'];	
	$_SESSION['ge_smtp'] = $cInfo['nom_banco'];
	$_SESSION['ge_smtphost'] = $cInfo['nom_cuenta'];
	$_SESSION['ge_smtpuser'] = $cInfo['nro_cuenta'];
	
	
	$query = $db->query("SELECT *	FROM manager_admin WHERE name = '$user' AND pwd = '$pwd' AND estado = '1'");
	$rowCount = $query->num_rows;		
	if($rowCount >= 1) {
			
			$_SESSION['user_name']= $user;	
			$_SESSION['user_type']= 'Administrator';
			echo '<div class="alert alert-succes" role="alert" align="center">
			<strong>'.$welcome.'<br><br>'.$user.'</strong></div>';
			echo '<center><img src="dashboard/img/preloader.gif"></center><br>';
			echo '<meta http-equiv="refresh"  content="2;url=dashboard/index.php">';
			
	} else {
			require 'requirelanguage.php';
			$query = $db->query("SELECT name_parson	FROM manager_user WHERE name = '$user' AND pwd = '$pwd' AND estado = '1'");
			$rowCount = $query->num_rows;		
		if($rowCount >= 1) {
				
				$_SESSION['user_name']= $user;	
				$_SESSION['user_type']= 'Employee';
				echo '<div class="alert alert-succes" role="alert" align="center">
				<strong>'.$welcome.'<br><br>'.$user.'</strong></div>';
				echo '<center><img src="dashboard/img/preloader.gif"></center><br>';
				echo '<meta http-equiv="refresh"  content="2;url=dashboard/index.php">';					
		} else {			
				require 'requirelanguage.php';
				$query = $db->query("SELECT name	FROM tbl_clients WHERE email = '$user' AND password = '$pwd' AND estado = '1'");
				$rowCount = $query->num_rows;
			if($rowCount >= 1) {
					
				$_SESSION['user_name']= $user;
				$_SESSION['user_type']= 'client';	
				echo '<div class="alert alert-succes" role="alert" align="center">
				<strong>'.$welcome.'<br><br>'.$user.'</strong></div>';
				echo '<center><img src="dashboard/img/preloader.gif"></center><br>';
				echo '<meta http-equiv="refresh"  content="2;url=dashboard/panel-customer/customer.php">';
			}	else {
				echo mensajes(''.$userpass.'<br>','rojo'); 
				echo '<center><a href="login.php" class="btn btn-danger"><strong>'.$intent.'</strong></a></center>';
			}		
		}//else
	}

}

switch($action) {
	
	case 'logOut':
		logOut();
	break;			
}

function logOut(){
	if(isset($_SESSION['user_name'])){
		unset($_SESSION['user_name']);
	}
	if(isset($_SESSION['user_type'])){
		unset($_SESSION['user_type']);
	}
	if(isset($_SESSION['user_customer'])){
		unset($_SESSION['user_customer']);
	}

	header('Location: ../index.php');
}//logOut

function isUser(){

	if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_name']) && !isset($_SESSION['user_customer'])) {
	  session_unset();
	  session_destroy();
	  header('Location: ../login.php');
	  exit;
	}
}


	
?>
