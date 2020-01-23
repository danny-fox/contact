<?php

// Function to clean potentially dirty data
function sanitise($data){
	// Sanitise/Escape special characters
	$cleanData = htmlentities($data, ENT_QUOTES, 'UTF-8');
	// Strip tags to remove any HTML
	$cleanData = strip_tags($cleanData);
	return $cleanData;
}


// Function to return message then exit script
function message($status, $message, $failedField  = false){
	// JSON Encode message/status for Ajax return
	echo json_encode(['status' => $status, 'message' => $message, 'field' => $failedField]);
	// Now exit script
	exit();
}


$name = sanitise($_POST['name']);
$email = sanitise($_POST['email']);
$phone = sanitise($_POST['phone']);
$enquiry = sanitise($_POST['enquiry']);
$newsletter = $_POST['newsletter']; 
$terms = $_POST['terms'];

// If someone has somehow managed to bypass the required client-side validation
if(!$name){ 
	message('fail','You must enter your Name', 'name');
}

if(!$email){ 
	message('fail','You must enter your Email', 'email');
}

if($terms == "false"){ 
	message('fail','You must agree to the Privacy Policy');
}

if(!$enquiry){ 
	message('fail','You must enter your Enquiry', 'enquiry');
}

if($newsletter == "true"){
	// Here we'd put some code to sign the user up to the newsletter using $name and $email. 
	// This would either be a SQL INSERT if you manage your own newsletter, or API based if you use something like MailChimp
}


// If I had a database connection and the table was set up, the next two lines wouldn't be here.
message('success','Your enquiry has been submitted. Thank You.');
exit(); 




// Once all data is confirmed, I feel like the best thing would be to send it to a database (from there we could create a support system to manage contact form entries as support tickets)
// Using mysqli for escape string reasons

$mysqli = new mysqli("host","db_user","db_pass","db_name");
if ($mysqli -> connect_errno) { // Failed to connect
	// I would log '$mysqli->connect_error' here 
	// User-friendly message when the error is database connection related
	message('fail','There was an error submitting your form. Please try again later');
}

// Making inputs safe for SQL
$name = $mysqli->real_escape_string($name);
$email = $mysqli->real_escape_string($email);
$phone = $mysqli->real_escape_string($phone);
$enquiry = $mysqli->real_escape_string($enquiry);

// Below SQL query: Status would be the status of the ticket (i.e. unanswered, replied, closed, etc. Initial status of 1 would be "unanswered").
$sql = "INSERT INTO contact_form (timestamp, name, email, phone, enquiry, status) VALUES ('".time()."', '".$name."', '".$email."', '".$phone."', '".$enquiry."' ,'1')";
 
if (!$mysqli->query($sql)) { 
	// Successfully entered data into database
	message('success','Your enquiry has been submitted. Thank You.');
}

$mysqli->close();
