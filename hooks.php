<?php
/**
 * Register hook function call.
 *
 * @param string $hookPoint The hook point to call
 * @param integer $priority The priority for the given hook function
 * @param string|function Function name to call or anonymous function.
 *
 * @return Depends on hook function point.
 */

// Require the intercom.io SDK and use it.
require "vendor/autoload.php";
use Intercom\IntercomClient;

// Set Intercom Access Token
$access_token = '';
$lead_email = 'eric@ericbaker.me';

// Connect to Intercom
$intercom = new IntercomClient( $access_token, null);

// Get a lead by email
function get_intercomio_lead_id_by_email($api_connection, $email) {
	return $api_connection->leads->getLeads(['email' => $email])->contacts[0]->id;
}

// Do the stuff to find the lead and convert into a user
function convert_lead_to_user($lead_email) {
	// Convert the Lead to a User
	$lead->convertLead([
	  "contact" => [
	    "user_id" => get_intercomio_lead_id_by_email($intercom, $lead_email);
	  ],
	  "user" => [
	    "email" => $lead_email
	  ]
	]);
}

// Now create the hook and call the function
//add_hook('ClientAdd', 1, convert_lead_to_user($vars['email']));

