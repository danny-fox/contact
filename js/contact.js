
$(document).ready(function(){
	
	// Below adds a class to the input parent when a user inputs into a field, this allows to do some cool/simple animations with labels instead of just using placeholder=""
	// Bind input/change instead of keyUp as keyUp won't register if a user pastes information instead of typing it
	$('.input-container input, .input-container textarea').bind('input change', function(){
		if($(this).val()){ // If field has data
			$(this).parent().addClass('filled');
		} else { // If field is/becomes empty
			$(this).parent().removeClass('filled');
		}
	});
	
	
	// Privacy policy popup fading Out/In functions
	$('.privacy-policy-close, .privacy-policy-background').on('click', function(){
		$('.privacy-policy-popup').fadeOut();
	});
	
	$('.privacy-policy-trigger').on('click', function(){
		$('.privacy-policy-popup').fadeIn().css('display', 'flex');
	});
	
	// Below is a function to highlight a field if it failed validation
	function failedField(fieldId){
		$('#'+fieldId).addClass('validation-fail');
		$('.form-message').addClass('fail').fadeIn().html('You must enter your <span>'+fieldId+'</span>');
	}
	
	// Below is a function to return an error specifically for invalid email address formats
	function failedEmail(fieldId){
		$('#'+fieldId).addClass('validation-fail');
		$('.form-message').addClass('fail').fadeIn().html('Please enter a valid email address');
	}

	
	// Below is a function that uses regex to check if an email address is the valid format (this is the only piece of code that's copy pasted)
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	};
	
	// Form submit function
	$("section.contact-form form").submit(function(e) {
		
		
		// Prevent form firing, run our validation/Ajax instead
		e.preventDefault();
		
		// Clear previous failed field warnings
		$('.form-message').hide().removeClass('fail');
		$('.input-container input, .input-container textarea').removeClass('validation-fail');
		
		// Data to send
		name = $('#name').val();
		email = $('#email').val();
		phone = $('#phone').val();
		newsletter = $('#newsletter').is(":checked");
		terms = $('#terms').is(":checked");
		enquiry = $('#enquiry').val();
		
		// Now to validate if the user has missed any required fields
		var validationFail = false; // Reset validation flag
		
		// Below I loop through each required input/textarea and check if it has a value
		$('.input-container.input-required input, .input-container.textarea-required textarea').each(function(){
			if(!$(this).val()){
				failedField($(this).attr('id'));
				validationFail = true; // Set a flag to say validation failed
				return false; // Stop the loop at first fail
			} else if($(this).attr('type') == 'email'){
				if(!isValidEmailAddress($(this).val())){ // If validation fails due to an incorrect email format. input type="email" does this with most browsers, but users browsers can't be guaranteed.
					failedEmail($(this).attr('id'));
					validationFail = true;
					return false; // Stop the loop at first fail
				}
			}
		});
		
		if(!validationFail){
			// Below I loop through required checkboxes (after the above), seperate from above because .val() does get whether these are ticked or not
			$('.checkbox-container.checkbox-required input').each(function(){
				if(!$(this).is(":checked")){
					$('.form-message').addClass('fail').fadeIn().html('You must agree to the Privacy Policy');
					validationFail = true; // Set a flag to say validation failed
					return false; // Stop the loop at first fail
				}	
			});
		}
		
		if(!validationFail){
		
			// Using Ajax to send the data to the PHP file for validation/database entry
			$.ajax({
				type: 'POST',
				url: 'ajax/contact.php',
				data: {name:name, email:email, phone:phone, newsletter:newsletter, terms:terms, enquiry:enquiry},
				success: function(response){
					// Show response message
					$('.form-message').addClass(response['status']).fadeIn().html(response['message']);
					
					// Highlight failed field
					if(response['field']){
						failedField(response['field']);
					}
					
					// Hide submit button on success
					if(response['status'] == 'success'){
						$('.form-submit').hide();
					}
				},
				dataType:"json"
			});
		}
		
	});
	

});