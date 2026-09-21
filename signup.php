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
require_once('dashboard/database-settings.php');

$db = conexion();
# datos de la compañia
$qryCompany = $db->query("SELECT cname, description, keywords, footer_website FROM company");
$company = $qryCompany->fetch_array();

# datos de la tabla paises
$querys = $db->query("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");
$rowsCount = $querys->num_rows;

?>
<!DOCTYPE html>

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $company['cname']; ?> | Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $company['description']; ?>"/>
	<meta name="keywords" content="<?php echo $company['keywords']; ?>" />
	<meta name="author" content="Jaomweb">


  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="dashboard/css/login/css/bootstrap.min.css">
	<link rel="stylesheet" href="dashboard/css/login/css/animate.css">
	<link rel="stylesheet" href="dashboard/css/login/css/style.css">

	<!-- Modernizr JS -->
	<script src="dashboard/css/login/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="menu">
						<img src="dashboard/logo-image/image_logo.php?id=1" height="45" width="241" />
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">	

					<!-- Start Sign In Form -->
					<form action="dashboard/settings/customer_registration/registration.php"  method="POST"  name="mi_formulario" class="fh5co-form animate-box" data-animate-effect="fadeIn" onSubmit="return validar_clave()">
						<h2>Sign Up</h2>
						<div class="form-group">
						<?php if ( isset ( $_GET ['tipo'] ) ) { ?>
							<div class="row alertaCaja" style="display: none;">
								<div class="col-xs-12 col-sm-12 col-md-12" style="float: none; margin: 0 auto;">
									<div class="alert alert-dismissible alert-<?php echo $_GET ['tipo'] ?>">
										<button type="button" class="close" data-dismiss="alert">x</button>
										<strong>Oh something step!</strong> <?php echo $_GET ['mensaje']; ?>
									</div>
								</div>
							</div>
						<?php } ?>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="name" class="sr-only">Name</label>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="Name" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Last name" class="sr-only">Last name</label>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
							</div>
						</div>	
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Identification" class="sr-only">Identification</label>
								<input type="text" class="form-control" id="name" name="cc" placeholder="Identification" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Language" class="sr-only">Language</label>
								<select class="form-control" name="lang" >
									<option value="en_customer">English</option>
									<option value="fr_customer">French</option>
									<option value="hindi_customer">Hindi</option>
									<option value="es_customer">Spanish</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Email" class="sr-only">Email</label>
								<input type="email" name="email" class="form-control" id="re-password" placeholder="Email" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Company" class="sr-only">Company</label>
								<input type="text" name="company" class="form-control" placeholder="Name of the business" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="Phone 2" class="sr-only">Code Phone</label>
								<select type="text" name="code_phone" class="form-control" autocomplete="off">
									<option data-countrycode="AF" value="93">Afghanistan (+93)</option>
									<option data-countrycode="AL" value="355">Albania (+355)</option>
									<option data-countrycode="DZ" value="213">Algeria (+213)</option>
									<option data-countrycode="AS" value="1684">American Samoa (+1684)</option>
									<option data-countrycode="AD" value="376">Andorra (+376)</option>
									<option data-countrycode="AO" value="244">Angola (+244)</option>
									<option data-countrycode="AI" value="1264">Anguilla (+1264)</option>
									<option data-countrycode="AQ" value="0">Antarctica (+0)</option>
									<option data-countrycode="AG" value="1268">Antigua and Barbuda (+1268)</option>
									<option data-countrycode="AR" value="54">Argentina (+54)</option>
									<option data-countrycode="AM" value="374">Armenia (+374)</option>
									<option data-countrycode="AW" value="297">Aruba (+297)</option>
									<option data-countrycode="AU" value="61">Australia (+61)</option>
									<option data-countrycode="AT" value="43">Austria (+43)</option>
									<option data-countrycode="AZ" value="994">Azerbaijan (+994)</option>
									<option data-countrycode="BS" value="1242">Bahamas (+1242)</option>
									<option data-countrycode="BH" value="973">Bahrain (+973)</option>
									<option data-countrycode="BD" value="880">Bangladesh (+880)</option>
									<option data-countrycode="BB" value="1246">Barbados (+1246)</option>
									<option data-countrycode="BY" value="375">Belarus (+375)</option>
									<option data-countrycode="BE" value="32">Belgium (+32)</option>
									<option data-countrycode="BZ" value="501">Belize (+501)</option>
									<option data-countrycode="BJ" value="229">Benin (+229)</option>
									<option data-countrycode="BM" value="1441">Bermuda (+1441)</option>
									<option data-countrycode="BT" value="975">Bhutan (+975)</option>
									<option data-countrycode="BO" value="591">Bolivia (+591)</option>
									<option data-countrycode="BA" value="387">Bosnia and Herzegovina (+387)</option>
									<option data-countrycode="BW" value="267">Botswana (+267)</option>
									<option data-countrycode="BV" value="0">Bouvet Island (+0)</option>
									<option data-countrycode="BR" value="55">Brazil (+55)</option>
									<option data-countrycode="IO" value="246">British Indian Ocean Territory (+246)</option>
									<option data-countrycode="BN" value="673">Brunei Darussalam (+673)</option>
									<option data-countrycode="BG" value="359">Bulgaria (+359)</option>
									<option data-countrycode="BF" value="226">Burkina Faso (+226)</option>
									<option data-countrycode="BI" value="257">Burundi (+257)</option>
									<option data-countrycode="KH" value="855">Cambodia (+855)</option>
									<option data-countrycode="CM" value="237">Cameroon (+237)</option>
									<option data-countrycode="CA" value="1">Canada (+1)</option>
									<option data-countrycode="CV" value="238">Cape Verde (+238)</option>
									<option data-countrycode="KY" value="1345">Cayman Islands (+1345)</option>
									<option data-countrycode="CF" value="236">Central African Republic (+236)</option>
									<option data-countrycode="TD" value="235">Chad (+235)</option>
									<option data-countrycode="CL" value="56">Chile (+56)</option>
									<option data-countrycode="CN" value="86">China (+86)</option>
									<option data-countrycode="CX" value="61">Christmas Island (+61)</option>
									<option data-countrycode="CC" value="672">Cocos (Keeling) Islands (+672)</option>
									<option data-countrycode="CO" value="57">Colombia (+57)</option>
									<option data-countrycode="KM" value="269">Comoros (+269)</option>
									<option data-countrycode="CG" value="242">Congo (+242)</option>
									<option data-countrycode="CD" value="242">Congo, the Democratic Republic of the (+242)</option>
									<option data-countrycode="CK" value="682">Cook Islands (+682)</option>
									<option data-countrycode="CR" value="506">Costa Rica (+506)</option>
									<option data-countrycode="CI" value="225">Cote D'Ivoire (+225)</option>
									<option data-countrycode="HR" value="385">Croatia (+385)</option>
									<option data-countrycode="CU" value="53">Cuba (+53)</option>
									<option data-countrycode="CY" value="357">Cyprus (+357)</option>
									<option data-countrycode="CZ" value="420">Czech Republic (+420)</option>
									<option data-countrycode="DK" value="45">Denmark (+45)</option>
									<option data-countrycode="DJ" value="253">Djibouti (+253)</option>
									<option data-countrycode="DM" value="1767">Dominica (+1767)</option>
									<option data-countrycode="DO" value="1809">Dominican Republic (+1809)</option>
									<option data-countrycode="EC" value="593">Ecuador (+593)</option>
									<option data-countrycode="EG" value="20">Egypt (+20)</option>
									<option data-countrycode="SV" value="503">El Salvador (+503)</option>
									<option data-countrycode="GQ" value="240">Equatorial Guinea (+240)</option>
									<option data-countrycode="ER" value="291">Eritrea (+291)</option>
									<option data-countrycode="EE" value="372">Estonia (+372)</option>
									<option data-countrycode="ET" value="251">Ethiopia (+251)</option>
									<option data-countrycode="FK" value="500">Falkland Islands (Malvinas) (+500)</option>
									<option data-countrycode="FO" value="298">Faroe Islands (+298)</option>
									<option data-countrycode="FJ" value="679">Fiji (+679)</option>
									<option data-countrycode="FI" value="358">Finland (+358)</option>
									<option data-countrycode="FR" value="33">France (+33)</option>
									<option data-countrycode="GF" value="594">French Guiana (+594)</option>
									<option data-countrycode="PF" value="689">French Polynesia (+689)</option>
									<option data-countrycode="TF" value="0">French Southern Territories (+0)</option>
									<option data-countrycode="GA" value="241">Gabon (+241)</option>
									<option data-countrycode="GM" value="220">Gambia (+220)</option>
									<option data-countrycode="GE" value="995">Georgia (+995)</option>
									<option data-countrycode="DE" value="49">Germany (+49)</option>
									<option data-countrycode="GH" value="233">Ghana (+233)</option>
									<option data-countrycode="GI" value="350">Gibraltar (+350)</option>
									<option data-countrycode="GR" value="30">Greece (+30)</option>
									<option data-countrycode="GL" value="299">Greenland (+299)</option>
									<option data-countrycode="GD" value="1473">Grenada (+1473)</option>
									<option data-countrycode="GP" value="590">Guadeloupe (+590)</option>
									<option data-countrycode="GU" value="1671">Guam (+1671)</option>
									<option data-countrycode="GT" value="502">Guatemala (+502)</option>
									<option data-countrycode="GN" value="224">Guinea (+224)</option>
									<option data-countrycode="GW" value="245">Guinea-Bissau (+245)</option>
									<option data-countrycode="GY" value="592">Guyana (+592)</option>
									<option data-countrycode="HT" value="509">Haiti (+509)</option>
									<option data-countrycode="HM" value="0">Heard Island and Mcdonald Islands (+0)</option>
									<option data-countrycode="VA" value="39">Holy See (Vatican City State) (+39)</option>
									<option data-countrycode="HN" value="504">Honduras (+504)</option>
									<option data-countrycode="HK" value="852">Hong Kong (+852)</option>
									<option data-countrycode="HU" value="36">Hungary (+36)</option>
									<option data-countrycode="IS" value="354">Iceland (+354)</option>
									<option data-countrycode="IN" value="91">India (+91)</option>
									<option data-countrycode="ID" value="62">Indonesia (+62)</option>
									<option data-countrycode="IR" value="98">Iran, Islamic Republic of (+98)</option>
									<option data-countrycode="IQ" value="964">Iraq (+964)</option>
									<option data-countrycode="IE" value="353">Ireland (+353)</option>
									<option data-countrycode="IL" value="972">Israel (+972)</option>
									<option data-countrycode="IT" value="39">Italy (+39)</option>
									<option data-countrycode="JM" value="1876">Jamaica (+1876)</option>
									<option data-countrycode="JP" value="81">Japan (+81)</option>
									<option data-countrycode="JO" value="962">Jordan (+962)</option>
									<option data-countrycode="KZ" value="7">Kazakhstan (+7)</option>
									<option data-countrycode="KE" value="254">Kenya (+254)</option>
									<option data-countrycode="KI" value="686">Kiribati (+686)</option>
									<option data-countrycode="KP" value="850">Korea, Democratic People's Republic of (+850)</option>
									<option data-countrycode="KR" value="82">Korea, Republic of (+82)</option>
									<option data-countrycode="KW" value="965">Kuwait (+965)</option>
									<option data-countrycode="KG" value="996">Kyrgyzstan (+996)</option>
									<option data-countrycode="LA" value="856">Lao People's Democratic Republic (+856)</option>
									<option data-countrycode="LV" value="371">Latvia (+371)</option>
									<option data-countrycode="LB" value="961">Lebanon (+961)</option>
									<option data-countrycode="LS" value="266">Lesotho (+266)</option>
									<option data-countrycode="LR" value="231">Liberia (+231)</option>
									<option data-countrycode="LY" value="218">Libyan Arab Jamahiriya (+218)</option>
									<option data-countrycode="LI" value="423">Liechtenstein (+423)</option>
									<option data-countrycode="LT" value="370">Lithuania (+370)</option>
									<option data-countrycode="LU" value="352">Luxembourg (+352)</option>
									<option data-countrycode="MO" value="853">Macao (+853)</option>
									<option data-countrycode="MK" value="389">Macedonia, the Former Yugoslav Republic of (+389)</option>
									<option data-countrycode="MG" value="261">Madagascar (+261)</option>
									<option data-countrycode="MW" value="265">Malawi (+265)</option>
									<option data-countrycode="MY" value="60">Malaysia (+60)</option>
									<option data-countrycode="MV" value="960">Maldives (+960)</option>
									<option data-countrycode="ML" value="223">Mali (+223)</option>
									<option data-countrycode="MT" value="356">Malta (+356)</option>
									<option data-countrycode="MH" value="692">Marshall Islands (+692)</option>
									<option data-countrycode="MQ" value="596">Martinique (+596)</option>
									<option data-countrycode="MR" value="222">Mauritania (+222)</option>
									<option data-countrycode="MU" value="230">Mauritius (+230)</option>
									<option data-countrycode="YT" value="269">Mayotte (+269)</option>
									<option data-countrycode="MX" value="52">Mexico (+52)</option>
									<option data-countrycode="FM" value="691">Micronesia, Federated States of (+691)</option>
									<option data-countrycode="MD" value="373">Moldova, Republic of (+373)</option>
									<option data-countrycode="MC" value="377">Monaco (+377)</option>
									<option data-countrycode="MN" value="976">Mongolia (+976)</option>
									<option data-countrycode="MS" value="1664">Montserrat (+1664)</option>
									<option data-countrycode="MA" value="212">Morocco (+212)</option>
									<option data-countrycode="MZ" value="258">Mozambique (+258)</option>
									<option data-countrycode="MM" value="95">Myanmar (+95)</option>
									<option data-countrycode="NA" value="264">Namibia (+264)</option>
									<option data-countrycode="NR" value="674">Nauru (+674)</option>
									<option data-countrycode="NP" value="977">Nepal (+977)</option>
									<option data-countrycode="NL" value="31">Netherlands (+31)</option>
									<option data-countrycode="AN" value="599">Netherlands Antilles (+599)</option>
									<option data-countrycode="NC" value="687">New Caledonia (+687)</option>
									<option data-countrycode="NZ" value="64">New Zealand (+64)</option>
									<option data-countrycode="NI" value="505">Nicaragua (+505)</option>
									<option data-countrycode="NE" value="227">Niger (+227)</option>
									<option data-countrycode="NG" value="234">Nigeria (+234)</option>
									<option data-countrycode="NU" value="683">Niue (+683)</option>
									<option data-countrycode="NF" value="672">Norfolk Island (+672)</option>
									<option data-countrycode="MP" value="1670">Northern Mariana Islands (+1670)</option>
									<option data-countrycode="NO" value="47">Norway (+47)</option>
									<option data-countrycode="OM" value="968">Oman (+968)</option>
									<option data-countrycode="PK" value="92">Pakistan (+92)</option>
									<option data-countrycode="PW" value="680">Palau (+680)</option>
									<option data-countrycode="PS" value="970">Palestinian Territory, Occupied (+970)</option>
									<option data-countrycode="PA" value="507">Panama (+507)</option>
									<option data-countrycode="PG" value="675">Papua New Guinea (+675)</option>
									<option data-countrycode="PY" value="595">Paraguay (+595)</option>
									<option data-countrycode="PE" value="51">Peru (+51)</option>
									<option data-countrycode="PH" value="63">Philippines (+63)</option>
									<option data-countrycode="PN" value="0">Pitcairn (+0)</option>
									<option data-countrycode="PL" value="48">Poland (+48)</option>
									<option data-countrycode="PT" value="351">Portugal (+351)</option>
									<option data-countrycode="PR" value="1787">Puerto Rico (+1787)</option>
									<option data-countrycode="QA" value="974">Qatar (+974)</option>
									<option data-countrycode="RE" value="262">Reunion (+262)</option>
									<option data-countrycode="RO" value="40">Romania (+40)</option>
									<option data-countrycode="RU" value="70">Russian Federation (+70)</option>
									<option data-countrycode="RW" value="250">Rwanda (+250)</option>
									<option data-countrycode="SH" value="290">Saint Helena (+290)</option>
									<option data-countrycode="KN" value="1869">Saint Kitts and Nevis (+1869)</option>
									<option data-countrycode="LC" value="1758">Saint Lucia (+1758)</option>
									<option data-countrycode="PM" value="508">Saint Pierre and Miquelon (+508)</option>
									<option data-countrycode="VC" value="1784">Saint Vincent and the Grenadines (+1784)</option>
									<option data-countrycode="WS" value="684">Samoa (+684)</option>
									<option data-countrycode="SM" value="378">San Marino (+378)</option>
									<option data-countrycode="ST" value="239">Sao Tome and Principe (+239)</option>
									<option data-countrycode="SA" value="966">Saudi Arabia (+966)</option>
									<option data-countrycode="SN" value="221">Senegal (+221)</option>
									<option data-countrycode="CS" value="381">Serbia and Montenegro (+381)</option>
									<option data-countrycode="SC" value="248">Seychelles (+248)</option>
									<option data-countrycode="SL" value="232">Sierra Leone (+232)</option>
									<option data-countrycode="SG" value="65">Singapore (+65)</option>
									<option data-countrycode="SK" value="421">Slovakia (+421)</option>
									<option data-countrycode="SI" value="386">Slovenia (+386)</option>
									<option data-countrycode="SB" value="677">Solomon Islands (+677)</option>
									<option data-countrycode="SO" value="252">Somalia (+252)</option>
									<option data-countrycode="ZA" value="27">South Africa (+27)</option>
									<option data-countrycode="GS" value="0">South Georgia and the South Sandwich Islands (+0)</option>
									<option data-countrycode="ES" value="34">Spain (+34)</option>
									<option data-countrycode="LK" value="94">Sri Lanka (+94)</option>
									<option data-countrycode="SD" value="249">Sudan (+249)</option>
									<option data-countrycode="SR" value="597">Suriname (+597)</option>
									<option data-countrycode="SJ" value="47">Svalbard and Jan Mayen (+47)</option>
									<option data-countrycode="SZ" value="268">Swaziland (+268)</option>
									<option data-countrycode="SE" value="46">Sweden (+46)</option>
									<option data-countrycode="CH" value="41">Switzerland (+41)</option>
									<option data-countrycode="SY" value="963">Syrian Arab Republic (+963)</option>
									<option data-countrycode="TW" value="886">Taiwan, Province of China (+886)</option>
									<option data-countrycode="TJ" value="992">Tajikistan (+992)</option>
									<option data-countrycode="TZ" value="255">Tanzania, United Republic of (+255)</option>
									<option data-countrycode="TH" value="66">Thailand (+66)</option>
									<option data-countrycode="TL" value="670">Timor-Leste (+670)</option>
									<option data-countrycode="TG" value="228">Togo (+228)</option>
									<option data-countrycode="TK" value="690">Tokelau (+690)</option>
									<option data-countrycode="TO" value="676">Tonga (+676)</option>
									<option data-countrycode="TT" value="1868">Trinidad and Tobago (+1868)</option>
									<option data-countrycode="TN" value="216">Tunisia (+216)</option>
									<option data-countrycode="TR" value="90">Turkey (+90)</option>
									<option data-countrycode="TM" value="7370">Turkmenistan (+7370)</option>
									<option data-countrycode="TC" value="1649">Turks and Caicos Islands (+1649)</option>
									<option data-countrycode="TV" value="688">Tuvalu (+688)</option>
									<option data-countrycode="UG" value="256">Uganda (+256)</option>
									<option data-countrycode="UA" value="380">Ukraine (+380)</option>
									<option data-countrycode="AE" value="971">United Arab Emirates (+971)</option>
									<option data-countrycode="GB" value="44">United Kingdom (+44)</option>
									<option data-countrycode="US" value="1">United States (+1)</option>
									<option data-countrycode="UM" value="1">United States Minor Outlying Islands (+1)</option>
									<option data-countrycode="UY" value="598">Uruguay (+598)</option>
									<option data-countrycode="UZ" value="998">Uzbekistan (+998)</option>
									<option data-countrycode="VU" value="678">Vanuatu (+678)</option>
									<option data-countrycode="VE" value="58">Venezuela (+58)</option>
									<option data-countrycode="VN" value="84">Viet Nam (+84)</option>
									<option data-countrycode="VG" value="1284">Virgin Islands, British (+1284)</option>
									<option data-countrycode="VI" value="1340">Virgin Islands, U.s. (+1340)</option>
									<option data-countrycode="WF" value="681">Wallis and Futuna (+681)</option>
									<option data-countrycode="EH" value="212">Western Sahara (+212)</option>
									<option data-countrycode="YE" value="967">Yemen (+967)</option>
									<option data-countrycode="ZM" value="260">Zambia (+260)</option>
									<option data-countrycode="ZW" value="263">Zimbabwe (+263)</option>
								</select>								
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="Phone 1" class="sr-only">Phone 1</label>
								<input type="text" name="phone" class="form-control" placeholder="Phone 1" autocomplete="off">
							</div>

							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="Phone 2" class="sr-only">Code Phone</label>
								<select type="text" name="code_phone1" class="form-control" autocomplete="off">
									<option data-countrycode="AF" value="93">Afghanistan (+93)</option>
									<option data-countrycode="AL" value="355">Albania (+355)</option>
									<option data-countrycode="DZ" value="213">Algeria (+213)</option>
									<option data-countrycode="AS" value="1684">American Samoa (+1684)</option>
									<option data-countrycode="AD" value="376">Andorra (+376)</option>
									<option data-countrycode="AO" value="244">Angola (+244)</option>
									<option data-countrycode="AI" value="1264">Anguilla (+1264)</option>
									<option data-countrycode="AQ" value="0">Antarctica (+0)</option>
									<option data-countrycode="AG" value="1268">Antigua and Barbuda (+1268)</option>
									<option data-countrycode="AR" value="54">Argentina (+54)</option>
									<option data-countrycode="AM" value="374">Armenia (+374)</option>
									<option data-countrycode="AW" value="297">Aruba (+297)</option>
									<option data-countrycode="AU" value="61">Australia (+61)</option>
									<option data-countrycode="AT" value="43">Austria (+43)</option>
									<option data-countrycode="AZ" value="994">Azerbaijan (+994)</option>
									<option data-countrycode="BS" value="1242">Bahamas (+1242)</option>
									<option data-countrycode="BH" value="973">Bahrain (+973)</option>
									<option data-countrycode="BD" value="880">Bangladesh (+880)</option>
									<option data-countrycode="BB" value="1246">Barbados (+1246)</option>
									<option data-countrycode="BY" value="375">Belarus (+375)</option>
									<option data-countrycode="BE" value="32">Belgium (+32)</option>
									<option data-countrycode="BZ" value="501">Belize (+501)</option>
									<option data-countrycode="BJ" value="229">Benin (+229)</option>
									<option data-countrycode="BM" value="1441">Bermuda (+1441)</option>
									<option data-countrycode="BT" value="975">Bhutan (+975)</option>
									<option data-countrycode="BO" value="591">Bolivia (+591)</option>
									<option data-countrycode="BA" value="387">Bosnia and Herzegovina (+387)</option>
									<option data-countrycode="BW" value="267">Botswana (+267)</option>
									<option data-countrycode="BV" value="0">Bouvet Island (+0)</option>
									<option data-countrycode="BR" value="55">Brazil (+55)</option>
									<option data-countrycode="IO" value="246">British Indian Ocean Territory (+246)</option>
									<option data-countrycode="BN" value="673">Brunei Darussalam (+673)</option>
									<option data-countrycode="BG" value="359">Bulgaria (+359)</option>
									<option data-countrycode="BF" value="226">Burkina Faso (+226)</option>
									<option data-countrycode="BI" value="257">Burundi (+257)</option>
									<option data-countrycode="KH" value="855">Cambodia (+855)</option>
									<option data-countrycode="CM" value="237">Cameroon (+237)</option>
									<option data-countrycode="CA" value="1">Canada (+1)</option>
									<option data-countrycode="CV" value="238">Cape Verde (+238)</option>
									<option data-countrycode="KY" value="1345">Cayman Islands (+1345)</option>
									<option data-countrycode="CF" value="236">Central African Republic (+236)</option>
									<option data-countrycode="TD" value="235">Chad (+235)</option>
									<option data-countrycode="CL" value="56">Chile (+56)</option>
									<option data-countrycode="CN" value="86">China (+86)</option>
									<option data-countrycode="CX" value="61">Christmas Island (+61)</option>
									<option data-countrycode="CC" value="672">Cocos (Keeling) Islands (+672)</option>
									<option data-countrycode="CO" value="57">Colombia (+57)</option>
									<option data-countrycode="KM" value="269">Comoros (+269)</option>
									<option data-countrycode="CG" value="242">Congo (+242)</option>
									<option data-countrycode="CD" value="242">Congo, the Democratic Republic of the (+242)</option>
									<option data-countrycode="CK" value="682">Cook Islands (+682)</option>
									<option data-countrycode="CR" value="506">Costa Rica (+506)</option>
									<option data-countrycode="CI" value="225">Cote D'Ivoire (+225)</option>
									<option data-countrycode="HR" value="385">Croatia (+385)</option>
									<option data-countrycode="CU" value="53">Cuba (+53)</option>
									<option data-countrycode="CY" value="357">Cyprus (+357)</option>
									<option data-countrycode="CZ" value="420">Czech Republic (+420)</option>
									<option data-countrycode="DK" value="45">Denmark (+45)</option>
									<option data-countrycode="DJ" value="253">Djibouti (+253)</option>
									<option data-countrycode="DM" value="1767">Dominica (+1767)</option>
									<option data-countrycode="DO" value="1809">Dominican Republic (+1809)</option>
									<option data-countrycode="EC" value="593">Ecuador (+593)</option>
									<option data-countrycode="EG" value="20">Egypt (+20)</option>
									<option data-countrycode="SV" value="503">El Salvador (+503)</option>
									<option data-countrycode="GQ" value="240">Equatorial Guinea (+240)</option>
									<option data-countrycode="ER" value="291">Eritrea (+291)</option>
									<option data-countrycode="EE" value="372">Estonia (+372)</option>
									<option data-countrycode="ET" value="251">Ethiopia (+251)</option>
									<option data-countrycode="FK" value="500">Falkland Islands (Malvinas) (+500)</option>
									<option data-countrycode="FO" value="298">Faroe Islands (+298)</option>
									<option data-countrycode="FJ" value="679">Fiji (+679)</option>
									<option data-countrycode="FI" value="358">Finland (+358)</option>
									<option data-countrycode="FR" value="33">France (+33)</option>
									<option data-countrycode="GF" value="594">French Guiana (+594)</option>
									<option data-countrycode="PF" value="689">French Polynesia (+689)</option>
									<option data-countrycode="TF" value="0">French Southern Territories (+0)</option>
									<option data-countrycode="GA" value="241">Gabon (+241)</option>
									<option data-countrycode="GM" value="220">Gambia (+220)</option>
									<option data-countrycode="GE" value="995">Georgia (+995)</option>
									<option data-countrycode="DE" value="49">Germany (+49)</option>
									<option data-countrycode="GH" value="233">Ghana (+233)</option>
									<option data-countrycode="GI" value="350">Gibraltar (+350)</option>
									<option data-countrycode="GR" value="30">Greece (+30)</option>
									<option data-countrycode="GL" value="299">Greenland (+299)</option>
									<option data-countrycode="GD" value="1473">Grenada (+1473)</option>
									<option data-countrycode="GP" value="590">Guadeloupe (+590)</option>
									<option data-countrycode="GU" value="1671">Guam (+1671)</option>
									<option data-countrycode="GT" value="502">Guatemala (+502)</option>
									<option data-countrycode="GN" value="224">Guinea (+224)</option>
									<option data-countrycode="GW" value="245">Guinea-Bissau (+245)</option>
									<option data-countrycode="GY" value="592">Guyana (+592)</option>
									<option data-countrycode="HT" value="509">Haiti (+509)</option>
									<option data-countrycode="HM" value="0">Heard Island and Mcdonald Islands (+0)</option>
									<option data-countrycode="VA" value="39">Holy See (Vatican City State) (+39)</option>
									<option data-countrycode="HN" value="504">Honduras (+504)</option>
									<option data-countrycode="HK" value="852">Hong Kong (+852)</option>
									<option data-countrycode="HU" value="36">Hungary (+36)</option>
									<option data-countrycode="IS" value="354">Iceland (+354)</option>
									<option data-countrycode="IN" value="91">India (+91)</option>
									<option data-countrycode="ID" value="62">Indonesia (+62)</option>
									<option data-countrycode="IR" value="98">Iran, Islamic Republic of (+98)</option>
									<option data-countrycode="IQ" value="964">Iraq (+964)</option>
									<option data-countrycode="IE" value="353">Ireland (+353)</option>
									<option data-countrycode="IL" value="972">Israel (+972)</option>
									<option data-countrycode="IT" value="39">Italy (+39)</option>
									<option data-countrycode="JM" value="1876">Jamaica (+1876)</option>
									<option data-countrycode="JP" value="81">Japan (+81)</option>
									<option data-countrycode="JO" value="962">Jordan (+962)</option>
									<option data-countrycode="KZ" value="7">Kazakhstan (+7)</option>
									<option data-countrycode="KE" value="254">Kenya (+254)</option>
									<option data-countrycode="KI" value="686">Kiribati (+686)</option>
									<option data-countrycode="KP" value="850">Korea, Democratic People's Republic of (+850)</option>
									<option data-countrycode="KR" value="82">Korea, Republic of (+82)</option>
									<option data-countrycode="KW" value="965">Kuwait (+965)</option>
									<option data-countrycode="KG" value="996">Kyrgyzstan (+996)</option>
									<option data-countrycode="LA" value="856">Lao People's Democratic Republic (+856)</option>
									<option data-countrycode="LV" value="371">Latvia (+371)</option>
									<option data-countrycode="LB" value="961">Lebanon (+961)</option>
									<option data-countrycode="LS" value="266">Lesotho (+266)</option>
									<option data-countrycode="LR" value="231">Liberia (+231)</option>
									<option data-countrycode="LY" value="218">Libyan Arab Jamahiriya (+218)</option>
									<option data-countrycode="LI" value="423">Liechtenstein (+423)</option>
									<option data-countrycode="LT" value="370">Lithuania (+370)</option>
									<option data-countrycode="LU" value="352">Luxembourg (+352)</option>
									<option data-countrycode="MO" value="853">Macao (+853)</option>
									<option data-countrycode="MK" value="389">Macedonia, the Former Yugoslav Republic of (+389)</option>
									<option data-countrycode="MG" value="261">Madagascar (+261)</option>
									<option data-countrycode="MW" value="265">Malawi (+265)</option>
									<option data-countrycode="MY" value="60">Malaysia (+60)</option>
									<option data-countrycode="MV" value="960">Maldives (+960)</option>
									<option data-countrycode="ML" value="223">Mali (+223)</option>
									<option data-countrycode="MT" value="356">Malta (+356)</option>
									<option data-countrycode="MH" value="692">Marshall Islands (+692)</option>
									<option data-countrycode="MQ" value="596">Martinique (+596)</option>
									<option data-countrycode="MR" value="222">Mauritania (+222)</option>
									<option data-countrycode="MU" value="230">Mauritius (+230)</option>
									<option data-countrycode="YT" value="269">Mayotte (+269)</option>
									<option data-countrycode="MX" value="52">Mexico (+52)</option>
									<option data-countrycode="FM" value="691">Micronesia, Federated States of (+691)</option>
									<option data-countrycode="MD" value="373">Moldova, Republic of (+373)</option>
									<option data-countrycode="MC" value="377">Monaco (+377)</option>
									<option data-countrycode="MN" value="976">Mongolia (+976)</option>
									<option data-countrycode="MS" value="1664">Montserrat (+1664)</option>
									<option data-countrycode="MA" value="212">Morocco (+212)</option>
									<option data-countrycode="MZ" value="258">Mozambique (+258)</option>
									<option data-countrycode="MM" value="95">Myanmar (+95)</option>
									<option data-countrycode="NA" value="264">Namibia (+264)</option>
									<option data-countrycode="NR" value="674">Nauru (+674)</option>
									<option data-countrycode="NP" value="977">Nepal (+977)</option>
									<option data-countrycode="NL" value="31">Netherlands (+31)</option>
									<option data-countrycode="AN" value="599">Netherlands Antilles (+599)</option>
									<option data-countrycode="NC" value="687">New Caledonia (+687)</option>
									<option data-countrycode="NZ" value="64">New Zealand (+64)</option>
									<option data-countrycode="NI" value="505">Nicaragua (+505)</option>
									<option data-countrycode="NE" value="227">Niger (+227)</option>
									<option data-countrycode="NG" value="234">Nigeria (+234)</option>
									<option data-countrycode="NU" value="683">Niue (+683)</option>
									<option data-countrycode="NF" value="672">Norfolk Island (+672)</option>
									<option data-countrycode="MP" value="1670">Northern Mariana Islands (+1670)</option>
									<option data-countrycode="NO" value="47">Norway (+47)</option>
									<option data-countrycode="OM" value="968">Oman (+968)</option>
									<option data-countrycode="PK" value="92">Pakistan (+92)</option>
									<option data-countrycode="PW" value="680">Palau (+680)</option>
									<option data-countrycode="PS" value="970">Palestinian Territory, Occupied (+970)</option>
									<option data-countrycode="PA" value="507">Panama (+507)</option>
									<option data-countrycode="PG" value="675">Papua New Guinea (+675)</option>
									<option data-countrycode="PY" value="595">Paraguay (+595)</option>
									<option data-countrycode="PE" value="51">Peru (+51)</option>
									<option data-countrycode="PH" value="63">Philippines (+63)</option>
									<option data-countrycode="PN" value="0">Pitcairn (+0)</option>
									<option data-countrycode="PL" value="48">Poland (+48)</option>
									<option data-countrycode="PT" value="351">Portugal (+351)</option>
									<option data-countrycode="PR" value="1787">Puerto Rico (+1787)</option>
									<option data-countrycode="QA" value="974">Qatar (+974)</option>
									<option data-countrycode="RE" value="262">Reunion (+262)</option>
									<option data-countrycode="RO" value="40">Romania (+40)</option>
									<option data-countrycode="RU" value="70">Russian Federation (+70)</option>
									<option data-countrycode="RW" value="250">Rwanda (+250)</option>
									<option data-countrycode="SH" value="290">Saint Helena (+290)</option>
									<option data-countrycode="KN" value="1869">Saint Kitts and Nevis (+1869)</option>
									<option data-countrycode="LC" value="1758">Saint Lucia (+1758)</option>
									<option data-countrycode="PM" value="508">Saint Pierre and Miquelon (+508)</option>
									<option data-countrycode="VC" value="1784">Saint Vincent and the Grenadines (+1784)</option>
									<option data-countrycode="WS" value="684">Samoa (+684)</option>
									<option data-countrycode="SM" value="378">San Marino (+378)</option>
									<option data-countrycode="ST" value="239">Sao Tome and Principe (+239)</option>
									<option data-countrycode="SA" value="966">Saudi Arabia (+966)</option>
									<option data-countrycode="SN" value="221">Senegal (+221)</option>
									<option data-countrycode="CS" value="381">Serbia and Montenegro (+381)</option>
									<option data-countrycode="SC" value="248">Seychelles (+248)</option>
									<option data-countrycode="SL" value="232">Sierra Leone (+232)</option>
									<option data-countrycode="SG" value="65">Singapore (+65)</option>
									<option data-countrycode="SK" value="421">Slovakia (+421)</option>
									<option data-countrycode="SI" value="386">Slovenia (+386)</option>
									<option data-countrycode="SB" value="677">Solomon Islands (+677)</option>
									<option data-countrycode="SO" value="252">Somalia (+252)</option>
									<option data-countrycode="ZA" value="27">South Africa (+27)</option>
									<option data-countrycode="GS" value="0">South Georgia and the South Sandwich Islands (+0)</option>
									<option data-countrycode="ES" value="34">Spain (+34)</option>
									<option data-countrycode="LK" value="94">Sri Lanka (+94)</option>
									<option data-countrycode="SD" value="249">Sudan (+249)</option>
									<option data-countrycode="SR" value="597">Suriname (+597)</option>
									<option data-countrycode="SJ" value="47">Svalbard and Jan Mayen (+47)</option>
									<option data-countrycode="SZ" value="268">Swaziland (+268)</option>
									<option data-countrycode="SE" value="46">Sweden (+46)</option>
									<option data-countrycode="CH" value="41">Switzerland (+41)</option>
									<option data-countrycode="SY" value="963">Syrian Arab Republic (+963)</option>
									<option data-countrycode="TW" value="886">Taiwan, Province of China (+886)</option>
									<option data-countrycode="TJ" value="992">Tajikistan (+992)</option>
									<option data-countrycode="TZ" value="255">Tanzania, United Republic of (+255)</option>
									<option data-countrycode="TH" value="66">Thailand (+66)</option>
									<option data-countrycode="TL" value="670">Timor-Leste (+670)</option>
									<option data-countrycode="TG" value="228">Togo (+228)</option>
									<option data-countrycode="TK" value="690">Tokelau (+690)</option>
									<option data-countrycode="TO" value="676">Tonga (+676)</option>
									<option data-countrycode="TT" value="1868">Trinidad and Tobago (+1868)</option>
									<option data-countrycode="TN" value="216">Tunisia (+216)</option>
									<option data-countrycode="TR" value="90">Turkey (+90)</option>
									<option data-countrycode="TM" value="7370">Turkmenistan (+7370)</option>
									<option data-countrycode="TC" value="1649">Turks and Caicos Islands (+1649)</option>
									<option data-countrycode="TV" value="688">Tuvalu (+688)</option>
									<option data-countrycode="UG" value="256">Uganda (+256)</option>
									<option data-countrycode="UA" value="380">Ukraine (+380)</option>
									<option data-countrycode="AE" value="971">United Arab Emirates (+971)</option>
									<option data-countrycode="GB" value="44">United Kingdom (+44)</option>
									<option data-countrycode="US" value="1">United States (+1)</option>
									<option data-countrycode="UM" value="1">United States Minor Outlying Islands (+1)</option>
									<option data-countrycode="UY" value="598">Uruguay (+598)</option>
									<option data-countrycode="UZ" value="998">Uzbekistan (+998)</option>
									<option data-countrycode="VU" value="678">Vanuatu (+678)</option>
									<option data-countrycode="VE" value="58">Venezuela (+58)</option>
									<option data-countrycode="VN" value="84">Viet Nam (+84)</option>
									<option data-countrycode="VG" value="1284">Virgin Islands, British (+1284)</option>
									<option data-countrycode="VI" value="1340">Virgin Islands, U.s. (+1340)</option>
									<option data-countrycode="WF" value="681">Wallis and Futuna (+681)</option>
									<option data-countrycode="EH" value="212">Western Sahara (+212)</option>
									<option data-countrycode="YE" value="967">Yemen (+967)</option>
									<option data-countrycode="ZM" value="260">Zambia (+260)</option>
									<option data-countrycode="ZW" value="263">Zimbabwe (+263)</option>
								</select>								
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="Phone 1" class="sr-only">Phone 2</label>
								<input type="text" name="telefono" class="form-control" placeholder="Phone 2" autocomplete="off">
							</div>

						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Country" class="sr-only">Country</label>
								<select type="text" name="country" id="country1" class="form-control" autocomplete="off">
								<option value="">Select Country</option>
									<?php
									
										if($rowsCount > 0){
											while($row = $querys->fetch_assoc()){ 
												echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
											}
										}else{
											echo '<option value="">País no disponible</option>';
										}
									?>														
								</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="State" class="sr-only">State</label>
								<select name="department" id="state1" class="form-control" autocomplete="off">
									<option value="">Select State first</option>
								</select>
							</div>	
							<div class="col-xs-12 col-sm-3 col-md-3" style="display:none">
								<label for="Iso" class="sr-only">Iso</label>
								<select  type="text" name="iso" id="iso1" class="form-control" autocomplete="off">  
									<option value="">Code</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="City" class="sr-only">City</label>
								<select type="text" name ="state" id="city1" class="form-control" placeholder="Enter city" autocomplete="off">
									<option value="">Select city first</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Address" class="sr-only">Address</label>
								<input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Enter Code Postal" class="sr-only">Enter Code Postal</label>
								<input type="text" name="zipcode" class="form-control" placeholder="Enter Code Postal" autocomplete="off">
							</div>
						</div>
						</br>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Password" class="sr-only">Password</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="Re-password" class="sr-only">Re-password</label>
								<input type="password" name="password2" id="repass" class="form-control" placeholder="Confirm Password" autocomplete="off">
							</div>
						</div>
						</br></br>
						<div class="row mb-1">
							<div class="col-xs-4 col-sm-3 col-md-3">
								<fieldset>
									<input type="checkbox" id="remember" class="chk-remember">
									<label for="remember-me"> I Agree</label>
								</fieldset>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-3" style="display:none">
								<fieldset>
									<input type="checkbox" id="remember-me" name="estado"  value="1" class="chk-remember">
									<label for="remember-me"> Status</label>
								</fieldset>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9">
								 <p class="font-small-3">By clicking Register, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.</p>
							</div>
						</div>
						<div class="form-group">
							<p>Already registered? <a href="login.php"><strong>Login</strong></a></p>
						</div>
						<div class="form-group">
							<i class="icon-head"></i><input type="submit" value="Register" class="btn btn-primary" onClick="checkval();">
						</div>
					</form>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small><?php echo $company['footer_website']; ?></small></p></div>
			</div>
		</div>
	
	<!-- jQuery -->
	<script src="dashboard/css/login/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="dashboard/css/login/js/bootstrap.min.js"></script>
	<!-- Placeholder -->
	<script src="dashboard/css/login/js/jquery.placeholder.min.js"></script>
	<!-- Waypoints -->
	<script src="dashboard/css/login/js/jquery.waypoints.min.js"></script>
	<!-- Main JS -->
	<script src="dashboard/css/login/js/main.js"></script>

	<script>
	$(function alertaBox()
	{
		$("div.alertaCaja").slideDown("fast");
		setTimeout(function(){
			window.history.replaceState( {} , '', document.URL.split('?')[0] );
			$("div.alertaCaja").slideUp("fast");
		}, 8000);
	});
	</script>
	<script LANGUAGE="JavaScript">
		function validar_clave() {
		var caract_invalido = " ";
		var caract_longitud = 6;
		var cla1 = document.mi_formulario.password.value;
		var cla2 = document.mi_formulario.password2.value;
		if (cla1 == '' || cla2 == '') {
		alert('You must enter your password in the two fields.');
		return false;
		}
		if (document.mi_formulario.password.value.length < caract_longitud) {
		alert('Your password should consist of ' + caract_longitud + ' characters.');
		return false;
		}
		if (document.mi_formulario.password.value.indexOf(caract_invalido) > -1) {
		alert("Keys cannot contain spaces");
		return false;
		}
		else {
		if (cla1 != cla2) {
		alert ("Introduced keys are not the same");
		return false;
		}
		else {
		alert('Correct password');
		return true;
			  }
		   }
		}
	</script>
	<script>
	
	$(document).ready(function(){
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'country_id='+countryID,
					success:function(html){
						$('#state1').html(html);
						$('#city1').html('<option value="">City</option>'); 
					}
				}); 
			}else{
				$('#state1').html('<option value="">Capital</option>');
				$('#city1').html('<option value="">City</option>'); 
			}
		});
		
		$('#country1').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'dashboard/ajaxpais1.php',
					data:'iso='+countryID,
					success:function(html){
						$('#iso1').html(html);
					}
				}); 
			}
		});
		$('#state1').on('change',function(){
			var stateID = $(this).val();
				if(stateID){
					$.ajax({
						type:'POST',
					   url:'dashboard/ajaxpais1.php',
						data:'state_id='+stateID,
						success:function(html){
							$('#city1').html(html);
						}
					}); 
				}else{
					$('#city1').html('<option value="">Select state first</option>'); 
				}
			});
		});		
	</script>
    <!-- END PAGE LEVEL JS-->

	</body>
</html>