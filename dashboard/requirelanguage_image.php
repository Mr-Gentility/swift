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
	
	## Obtengo datos del lenguaje
	$qryEmpresa =  mysql_query("SELECT * FROM company");

	while($company = mysql_fetch_array($qryEmpresa)) {

		/*Image Language*/

		$file="";
		if($company['lang']=='en') {
		 $file = APP_URL."/img/language/english.png";
		}
		elseif ($company['lang']=='es'){
		$file = APP_URL."/img/language/spanish.png";
		}
		elseif ($company['lang']=='fr'){
		$file = APP_URL."/img/language/french.png";
		}
		else {
		 $file = APP_URL."/img/language/hindi.png";
		}
	}
	
	# Obtengo datos del lenguaje clientes
	$qryClients =  mysql_query("SELECT * FROM tbl_clients WHERE email='".$_SESSION["user_name"]."'");

	while($clients = mysql_fetch_array($qryClients)) {

		/*Image Language*/

		$files="";
		if($clients['lang']=='en_customer') {
		 $files = APP_URL."/img/language/english.png";
		}
		elseif ($clients['lang']=='es_customer'){
		$files = APP_URL."/img/language/spanish.png";
		}
		elseif ($clients['lang']=='fr_customer'){
		$files = APP_URL."/img/language/french.png";
		}
		else {
		 $files = APP_URL."/img/language/hindi.png";
		}
	}
	
?>