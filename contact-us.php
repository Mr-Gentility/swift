<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
    <title>Get in Touch with  Us | DEPRIXA </title>
	<meta name="description" content="Courier Deprixa V3.2.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="shortcut icon" type="image/png" href="deprixa/img/favicon.png"/>
    
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" /> 
	<script src="deprixa_components/hub/js/jquery.min.js"></script>
	<script src="deprixa_components/hub/scripts/global.js"></script>
	<script src="deprixa_components/hub/scripts/bootstrap.min.js"></script>

	
	<link rel="stylesheet" href="deprixa_components/content/css/contact.css" />	
	<link rel="stylesheet" href="deprixa_components/content/hub/css/global.css" />
	<link rel="stylesheet" href="deprixa_components/content/hub/css/bootstrap-mpd.css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" >
	<link rel="stylesheet" href="deprixa_components/css/style-email.css" />	
    <style>
      .container {
				width: auto;
				max-width: 800px;
			  }
			  .form-group {
				margin-bottom: 8px;
			  }

    </style>

</head>
   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->
	
<div class="slide">   
    </div>
<main class="slide">
<div class="fw grey-bg">
<section class="get-in-touch">
	<header>
		<h1>Get in touch</h1>
	</header>
	<div class="col-lg-4 col-sm-4 col-sm-offset-2">
		<div class="iconbox"><span class="contact-icon-chat55"></span>
			<p>Live chat</p>
			<p class="info">Chat to us live now, it's the fastest way to get in touch. We're online 8am-6pm, Monday to Friday. Simply click the orange button in the bottom right of your screen.</p>
		</div>
	</div>

	<div class="mobHide col-lg-4 col-sm-4" style="display: none;">
		<div class="iconbox"><span class="contact-icon-call10"></span>
			<p>Phone us</p>
			<p class="info">Give us a call on 1223456789 and we'll be happy to help. We're on the phone 8.30am - 5.30pm. Monday to Friday</p>
		</div>
	</div>
	<div class="mobHide col-lg-4 col-sm-4">
			<div class="iconbox"><span class="help-icon-email20"></span>
				<p>Send a message</p>
				<p class="info">If you can't stay online for your answer, simply send us a message. We'll do our best to reply to all message within 2 business hours.</p>
				<button type="button" class="btn btn-primary primaryButtonSmall" data-toggle="modal" data-target=".zenDesk">Click here</button>
				<div class="modal fade zenDesk">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="closeModal" aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myLargeModalLabel">Send a message</h4>
							</div>
							<div class="container">

								<div class="page-header">
									<h3>write your questions and concerns and will respond soon. Thank you.</h3>
								</div>
									
								<div class="email-form">
									
									<form action="prose-form.php" method="post" class="contact-form"  onsubmit="return validar(this);">				
										<div class="formulario">
											<div class="column">
												<label for="Name">Name </label>
												<input type="text" name="name" class="form-input" onblur="revisar(this);"/>
												
												<label for="email">Email </label>
												<input type="email" name="email" class="form-input" onblur="revisar(this); revisaremail(this);"/>
												
												<label for="Message Subject">Message Subject </label>
												<input type="text" name="subject" class="form-input" onblur="revisar(this);"/>
											</div>
											
											<div class="column">
												<label for="Comment">Comment </label>
												<textarea name="comment" class="form-input" ></textarea>
											</div>				
											
											<input class="form-btn" type="submit" value="Send Message"/>
										</div>		
									</form>
								</div>    
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="mobOnly col-lg-4 col-sm-4">
			<div class="iconbox"><span class="help-icon-email20"></span>
			<p>Send a message</p>
			<a href="mailto:info@jaomweb.info" class="primaryButtonSmall">Click here</a></div>
		</div>
	</div>	
</section>

		<div class="fw">
			<section class="find-us">
				<header>
				<h1>Where to find us</h1>
				</header>
				<div class="col-lg-4 col-xs-12 details">
					<div class="mpd-address col-lg-12 col-sm-6 col-xs-12">
						<h2><span class="contact-icon-place4"></span>Address</h2>
						<address>
						<p><strong>Deprixa,</strong> <br /> No. 95, <br /> HELICONIE BEA , <br /> Medellin, Colombie, <br />057 Antioquia, <br /> Medellin, <br /> C31</p>
						</address>
					</div>
					<div class="companyinfo-container col-lg-12 col-sm-6 col-xs-12">
						<h2 class="companyinfo"><span class="contact-icon-information38"></span>Company Information</h2>
						<p><strong>Company Number:</strong> +60 7 3549409, <br /> Registered in England and Wales</p>
						<p><strong>VAT Number:</strong> +60 7 3541404</p>
					</div>
				</div>
				<div class="col-lg-8 col-xs-12">
					<div id="map-container"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126912.11113816842!2d-75.56172991760408!3d6.263271374416086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428ef4e52dddb%3A0x722fd6c39270ac72!2sMedell%C3%ADn%2C+Antioquia!5e0!3m2!1ses!2sco!4v1468552001805" frameborder="0" style="border: 0;"></iframe></div>
				</div>
			</section>
		</div>

</main>

    <!-- Footer -->
<?php include_once "footer.php"; ?>
    <!-- /Footer -->
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="contact/assets/vender/intl-tel-input/js/intlTelInput.min.js"></script>
    <script type='text/javascript' src='deprixa_components/js/form.js'></script>
	
	<script src="deprixa_components/content/jquery"></script>
   <script src="deprixa_components/content/bootstrap"></script>
</body>

</html>