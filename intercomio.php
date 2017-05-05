<?php
// Require the intercom.io SDK and use it.
require "vendor/autoload.php";
use Intercom\IntercomClient;

// Set Intercom Access Token
$access_token = '';

// Connect to Intercom
$intercom = new IntercomClient( $access_token, null);

// Do the stuff to find the lead and convert into a user
function convert_lead_to_user($lead_email) {
	// Get a Lead by Email
	$lead = $intercom->leads->getLeads(['email' => $lead_email]);

	// Convert the Lead to a User
	$lead->convertLead([
	  "contact" => [
	    "user_id" => $lead['id']
	  ],
	  "user" => [
	    "email" => $lead_email
	  ]
	]);
}

	
?>