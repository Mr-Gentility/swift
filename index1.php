<!DOCTYPE html>


<html>
<head>
	<meta charset="utf-8" />
	<title>Track My Parcel  | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V3.2.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
	<link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
	
	<!-- style -->
	<link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link href="deprixa_components/styles/track-order.css" rel="stylesheet" />	
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script>
	<script type="text/javascript" src="dashboard/js/countries.js"></script> 		
	<link rel="stylesheet" href="deprixa_components/hub/css/global.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/services.css" />
	<link rel="stylesheet" href="deprixa_components/hub/css/bootstrap-mpd.css" />				
	
   <!-- style -->  
	<link href="deprixa_components/styles/home1d2d.css" rel="stylesheet"/>
	<link rel="stylesheet" href="deprixa_components/styles/default.css" />
	
	<!-- Cloud Slider Style Sheet -->
	<link rel="stylesheet" href="cloudslider/css/cloudslider.css" type="text/css">

	<!-- Importing Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	<!-- Importing jQuery -->
	<script src="cloudslider/js/jquery.js" type="text/javascript"></script>

	<!-- Cloud Slider Library -->
	<script src="cloudslider/js/cloudslider.jquery.min.js" type="text/javascript"></script>
	
	<style type="text/css">
		#wrapper {
		position: relative;
		}

		#wrapper .text {
			position: absolute;
			visibility: hidden;
			width: 300%;
			bottom: 15px;
			left: -95px;
		}

		#wrapper:hover .text {
		visibility:visible;
		}	
	</style>
		
</head>

<!-- Menu -->
<?php include_once "menu.php"; ?>
<!-- /Menu -->
		

<main class="slide">
 <!--SLIDER -->	
 <div class="slide">	
	<div id="cloudslider" style="margin:0 auto;">
		<div class="kr-sky" data-duration="5000" data-transition="all" data-ken="scalefrom:0.0; positionfrom:left_top; scaleto:0.0; positionto:right_center; easing:linear; duration:10000;">
			<img class="sky-background" src="deprixa_components/images/slider/1.png">
		</div>
		
		<div class="kr-sky" data-duration="6000" data-transition="all" data-ken="scalefrom:0.0; positionfrom:left_top; scaleto:0.0; positionto:right_center; easing:linear; duration:10000;">
			<img class="sky-background" src="deprixa_components/images/slider/2.png">
		</div>

	</div>
</div>	  
	<div class="fw dark-grey-bg">
		<section class="h-form">
			<h2>Shipping Cost Calculator</h2>
			
			<p class="subTitle">Just pop your parcel details below and get a quote to check out all the services we have on offer from Deprixa and other couriers.</p>

			<div id="booking-pod-container" class="col-md-12">
				<form action="search-result.php" method="post" autocomplete="off" id="podForm">
					<div class="form-horizontal">
						<div id="pod-alert" class="alert alert-danger" style="display:none;">
							<p class="alert-message"></p>
						</div>
						<div class="col-sm-6">
							<div class="form-group fl form-from">
								<label for="From">From</label>
								<input type="hidden" id="FromCountryRegex" />
								<span id="inter_origin" style="display: block;">   
									<select onchange="print_state('state1', this.selectedIndex);" id="country1" required  name ="scountry" class="fa-glass booking_form_dropdown form-control"></select>
								</span>               
							</div>
							<div class="form-group fl form-from-postcode">
								<label for="FromPostcode">Select state</label>
									<span id="domestic_origin" >
										<select  name ="sstate" required  id ="state1" class="fa-glass booking_form_dropdown form-control"><option value="">Select state</option></select>    
									</span>
								<script language="javascript">print_country("country1");</script>
							</div>
							<div class="form-group cf fl form-to">
								<label for="To">To</label>
								<input type="hidden" id="ToCountryRegex" />
								<span id="inter_dest" style="display: block;">
									<select onchange="print_state('state2', this.selectedIndex);" id="country2" name ="dcountry" required class="fa-glass booking_form_dropdown form-control"></select>
								</span>                 
							</div>
							<div class="form-group fl form-to-postcode">
								<label for="ToPostcode">Select state</label>
									<span id="domestic_dest">
										<select  name ="dstate" required  id ="state2" class="fa-glass booking_form_dropdown form-control"><option value="">Select state</option></select>
									</span>
								<script language="javascript">print_country("country2");</script>
							</div>
						</div>	
						<div class="col-sm-6">		
							<div class="form-group fl form-dimensions cf">
								<label for="How_big_is_it_"><div id="wrapper"><span class="hover" style="position: relative;">How big is it?<img src="deprixa_components/images/question-mark.png" style="margin-top: -10px;width: 12px;"><img src="deprixa_components/images/box.jpg" class="text"></span></label>								
								<div class="form-dim-input cf">
									<input class="col-md-2 form-control" onblur="if(this.value == ''){this.value='0'}" onKeyUp="volumetrico();" id="volume3" name="length" placeholder="Length" tabindex="5" type="number" value="" min="0" required /> 
									<span class="error" id="LengthError"></span>
									<input class="col-md-2 form-control" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="svolumetrico();" id="volume2" name="width" placeholder="Width" tabindex="6" type="number" value="" min="0" required /> 
									<span class="error" id="WidthError"></span>
									<input class="col-md-2 form-control" onblur="if(this.value == ''){this.value='0'}"  onKeyUp="volumetrico();" id="volume1" name="height" placeholder="Height" tabindex="7" type="number" value="" min="0" required />
									<input name="parcel_contents_1" id="parcel_contents_1" type="hidden">
									<span class="error" id="HeightError"></span>
									<select class="form-control" id="DimensionType" name="DimensionType">
										<option>cm</option>
										<option>in</option>
									</select>
								</div>
							</div>
							<div class="form-group fl form-weight cf">
								<label for="How_heavy_">How heavy?</label>
								<input class="form-control cf text-box single-line" id="totalpeso" name="volumetric" tabindex="8" type="text" style="display:none;"  />
								<input class="form-control cf text-box single-line" name="Consignment" placeholder="Weight" tabindex="8" type="text" required  />
								<span class="error" id="WeightError"></span>
								<select class="form-control" id="WeightType" name="WeightType">
									<option>Kg</option>
									<option>Lbs</option>
								</select>
								<input name="Submit" type="submit" value="Get quotes" class="btn btn-primary fr ga-trackevent" tabindex="9" id="submitPod" data-gacat="BookingPodCustom" data-gaact="Submit" data-galab="Generic" />	
							</div>
						</div>		
					</div>        
				</form>
			</div>

		</section>
	</div>
	<div class="">
		<div class="fw grey-bg">
			<section class="trackorder-boxes">
				<div class="col-sm-6">
					<div class="pod">
						<div class="media-body">
							<span class="track-icon-close40 mpdLightBlue"></span>
							<h3>FREE SHIPPING</h3>
							<p><img src="deprixa_components/images/freeshipping.png" alt="Free Shipping" /></p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="pod">
						<div class="media-body">
							<span class="track-icon-back3 mpdRed"></span>
							<h3>HOW IT WORKS</h3>
							<p><img src="deprixa_components/images/dropshipping.png" alt="DPD" /></p>
							<a href="contact-us.php" class="btn btn-primary">Contact us</a>
						</div>
					</div>
				</div>
			</section>		
		</div>
	</div>
	
	<div class="mpd-stats">
		<section class="mpd-goods">
			<header><h2>Delivering the Goods</h2></header>
			<div class="box col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div>
					<img src="deprixa_components/images/promotion.jpg" alt="Promotions" />
					<div class="mpd-goods-rightCol">
						<h3>Promotions</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<a href="comparison.php" class="primaryButtonSmall ga-trackevent" data-gacat="HomePage" data-galab="HelpMe">Tell me more</a>
					</div>
				</div>
			</div>
			<div class="box col-xs-12 col-sm-6 col-md-6 col-lg-6 news-blog mobHide">
				<div>
					<img src="deprixa_components/images/box-prohibited.png" alt="Prohibited Box" />
					<div class="newsBlogRightCol">
						<h3>PROHIBITED & RESTRICTED ITEMS LIST</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						<a href="prohibited-restricted.php" class="primaryButtonSmall ga-trackevent" data-gacat="HomePage" data-galab="Win">Read more</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<?php include_once "footer.php"; ?>

</div>

    <script src="deprixa_components/bundles/bootstrap"></script>
	<script>

		$("#cloudslider").cloudSlider({
			width: 1920,
			height: 550,
			onHoverPause: false
		});

	</script>
	<script type="text/javascript">
		
		function volumetrico(){
			
			var num2 = "1.341";
			var volume1 = document.getElementById("volume1");
			var volume2 = document.getElementById("volume2");
			var volume3 = document.getElementById("volume3");
			var input = document.getElementById("totalpeso");
			totalpeso = parseFloat(Math.round(volume1.value * volume2.value * volume3.value) /6000 ).toFixed(1);
			input.value= totalpeso;
			
		}
	</script>

</body>
</html>
