<!DOCTYPE HTML>
<html>
<?php // I assume this contact form would be built into the main site? Is so, obviously the page structure (headers/footers/etc) would be in their own template files, for now this file just includes the entire page structure ?>
<?php // Also, I typically comment code in php, so it doesn't show in the DOM ?>	
	<head>
		<title>Lisa Angel - Contact Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script src="js/jquery-3.4.1.min.js"></script> 
		<script src="js/contact.js"></script>
	</head>

	<body>
		
		<header>
			<?php // Assuming this would be part of the main site, this page would also include the sites's nav/search/footer. For now I'll just include the logo as the header. ?>
			<img src="img/lisaangel-logo.svg" alt="Lisa Angel" />
		</header>
	
		<section class="contact-form">
			
			<h1>Contact Us</h1>
			<div class="contact-form-content">
				<p>Please use the below form if you wish to get in touch with us. One of our friendly staff members will aim to respond as soon as possible.</p>
			</div>
			
			<form>
				<div class="input-container input-required">
					<?php // Can do some fancier stuff with this compared to placeholder="" ?>
					<label for="name">Your Name*</label>
					<input type="text" name="name" id="name" autocomplete="off" maxlength="35" />
				</div>
				
				<div class="input-container input-required">
					<label for="email">Your Email*</label>
					<input type="email" name="email" id="email" autocomplete="off" maxlength="35" />
				</div>
				
				<div class="input-container">
					<label for="phone">Phone Number</label>
					<input type="tel" name="phone" id="phone" autocomplete="off" maxlength="20" />
				</div>
				
				<div class="checkbox-container">	
					<label for="newsletter">
						<input type="checkbox" name="newsletter" id="newsletter" />
						<div class="checkbox"></div> Would you like to sign up to our newsletter?
					</label>
				</div>
				
				<div class="checkbox-container checkbox-required">
					<label for="terms">
						<input type="checkbox" name="terms" id="terms" />
						<div class="checkbox"></div> Do you agree to our 
					</label>
					<?php // Below is outside of label as a simple way to not tick the checkbox when users click to read the Privacy Policy ?>
					<span class="privacy-policy-trigger">Privacy Policy?</span>
				</div>
				
				<div class="input-container textarea-required">
					<label for="enquiry">Your Enquiry*</label>
					<textarea id="enquiry" name="enquiry" rows="4"></textarea>
				</div>
				
				<input class="form-submit grey-button" type="submit" value="send" />
				<div class="form-message"></div>
				
			</form>
			
		</section>
		
		<?php // Privacy policy popup below ?>
		<section class="privacy-policy-popup">
			<?php // Below as it's own separate element so that click events can trigger (to close) without triggering when you click the content which looks like it's within the dark background ?>
			<div class="privacy-policy-background"></div>
			
			<div class="privacy-policy-container">
				<h2>Privacy Policy</h2>
				<div class="privacy-policy-content">
					<p>This in where your privacy policy goes</p>
					<p>I decided to implement it as a popup lightbox instead of linking you to another page so that users wouldn't lose their progress on the contact form</p>
				</div>
				<div class="privacy-policy-close grey-button">close</div>
			</div>
		</section>
	
	</body>
	
</html>