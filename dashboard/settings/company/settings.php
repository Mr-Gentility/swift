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
	require_once('../../database-settings.php');
	require_once('../../database.php');
	require '../../requirelanguage.php';
	require '../../css/GUMP/gump.class.php';

	#
	## Validos los valores que llegan del formulario
	$validator = new GUMP();

	// sanitizo la variable POST
	$_POST = $validator->sanitize($_POST);

	// defino reglas y filtros
	$validator->filter_rules( array(
		'cname'       	=> 	'trim|sanitize_string',
		'nit'    		=> 	'trim|sanitize_string',
		'cemail'        => 	'trim|sanitize_email',
		'cphone'       	=> 	'trim|sanitize_string',
		'city'     		=> 	'trim|sanitize_string',
		'website'       => 	'trim|sanitize_string',
		'footer_website'=> 	'trim|sanitize_string',
		'currency'     	=> 	'trim|sanitize_string',
		'country'     	=> 	'trim|sanitize_string',
		'measure'     	=> 	'trim|sanitize_string',
		'prefijo'       => 	'trim|sanitize_string',
		'cons_no'       => 	'trim|sanitize_string',
		'bemail'     	=> 	'trim|sanitize_email',
		'lang'			=> 	'trim|sanitize_string',
		'timezone'		=>	'trim|sanitize_string',
		'description'	=>	'trim|sanitize_string',
		'keywords'		=>	'trim|sanitize_string',
		'nom_banco'		=>	'trim|sanitize_string',
		'nom_cuenta'	=>	'trim|sanitize_string',
		'nro_cuenta'	=>	'trim|sanitize_string',
		'locker'	=>	'trim|sanitize_string',
		'dirlocker'	=>	'trim|sanitize_string'));		

		$validator->validation_rules( array(
		'cname'			=> 'required|min_len,3',
		'nit'    		=> 'required',
		'cemail'		=> 'required|valid_email',
		'cphone'       	=> 'required',
		'city'     		=> 'required',
		'website'       => 'required|valid_url',
		'footer_website'=> 'required',
		'currency'     	=> 'required',
		'country'       => 'required',
		'measure'       => 'required',
		'prefijo'		=> 'required',
		'cons_no'		=> 'required',
		'bemail'		=> 'required|valid_email',
		'lang'			=> 'required',
		'timezone' 		=> 'required',
		'description' 	=> 'required',
		'keywords' 		=> 'required',
		'nom_banco' 	=> 'required',
		'nom_cuenta' 	=> 'required',
		'nro_cuenta' 	=> 'required',
		'locker' 	    => 'required',
		'dirlocker' 	=> 'required'));
		
		

		// se realiza las validaciones
		$validated_data = $validator->run($_POST);

		# si hubo errores lo informamos
		if($validated_data === false) {
			header ( "Location: ../../preferences.php?tipo=danger&mensaje=".$validator->get_readable_errors(true));

		} else {
		
		$cname = $_POST['cname'];
		$nit = $_POST['nit'];
		$cemail = $_POST['cemail'];
		$cphone = $_POST['cphone'];
		$caddress = $_POST['caddress'];
		$country = $_POST['country'];
		$city = $_POST['city'];
		$website = $_POST['website'];
		$footer_website = $_POST['footer_website'];	
		$currency = $_POST['currency'];
		$measure = $_POST['measure'];
		$prefijo = $_POST['prefijo'];
		$cons_no = $_POST['cons_no'];
		$lang = $_POST['lang'];	
		$bemail = $_POST['bemail'];
		$date = $_POST['date'];
		$timezone = $_POST['timezone'];
		$description = $_POST['description'];
		$keywords = $_POST['keywords'];
		$nom_banco = $_POST['nom_banco'];
		$nom_cuenta = $_POST['nom_cuenta'];
		$nro_cuenta = $_POST['nro_cuenta'];
		$locker = $_POST['locker'];
		$dirlocker = $_POST['dirlocker'];

		$sql = "UPDATE company SET cname='$cname',nit='$nit',cemail='$cemail',cphone='$cphone',caddress='$caddress',country='$country',measure='$measure',prefijo='$prefijo',cons_no='$cons_no',city='$city', website='$website',footer_website='$footer_website',currency='$currency',lang='$lang',bemail='$bemail',date='$date',timezone='$timezone',description='$description',keywords='$keywords',nom_banco='$nom_banco', nom_cuenta='$nom_cuenta',nro_cuenta='$nro_cuenta',locker='$locker',dirlocker='$dirlocker'";
		dbQuery($sql);
		
		echo "<script type=\"text/javascript\">
				alert(\"$changeexits\");
				window.location = \"../../preferences.php\"
			</script>";	
	 
		}
    
    
?>