<?php
// Set Intercom Access Token
$access_token = 'dG9rOjViOGQ2Zjk1X2VlNThfNDM5OV84ZjMwX2RiNDQ0NzA5NGRiMzoxOjA=';
$lead_email = 'eric@ericbaker.me';

// Connect to Intercom & Get Lead ID
//$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL, "https://api.intercom.io/contacts?email=" . $lead_email);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


//$headers = array();
//$headers[] = "Authorization: Bearer " . $access_token;
//$headers[] = "Accept: application/json";
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//$lead = json_decode(curl_exec($ch));
//if (curl_errno($ch)) {
//    echo 'Error:' . curl_error($ch);
//}
//curl_close ($ch);


print_r($lead->contacts[0]->id);

// END -- Get Lead ID //

// Convert the lead into a user

//$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL, "https://api.intercom.io/contacts/convert");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, '{"contact":{"user_id":"' . $lead_id . '"},"user":{"email":"' . $lead_email . '"}}');
//curl_setopt($ch, CURLOPT_POST, 1);

//$headers = array();
//$headers[] = "Authorization: Bearer " . $access_token;
//$headers[] = "Accept: application/json";
//$headers[] = "Content-Type: application/json";
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//$result = curl_exec($ch);
//if (curl_errno($ch)) {
//    echo 'Error:' . curl_error($ch);
//}
//curl_close ($ch);

function curl_request($url, $access_token, $method = 'GET', $post_fields = NULL ) {
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

	// Set cURL options based on the method
	if ( $method == 'POST' ) {
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_fields );
		curl_setopt( $ch, CURLOPT_POST, 1);
	} else {
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "GET" );
	}

	// Set the Headers to authorize the request and accept json
	$headers = array();
	$headers[] = "Authorization: Bearer " . $access_token;
	$headers[] = "Accept: application/json";
	$headers[] = "Content-Type: application/json";
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

	// Execute the request
	$result = curl_exec( $ch );

	// Error handling
	if ( curl_errno( $ch ) ) {
    	echo 'Error:' . curl_error( $ch );
	} else {
		// If no error, return the result.
		return $result;
	}

	// Close the request
	curl_close( $ch );
}

function get_lead_id_by_email( $lead_email, $access_token ) {
	// Craft the url we want
	$request_url = "https://api.intercom.io/contacts?email=" . $lead_email;

	// Make the request
	$result = json_decode(curl_request( $request_url, $access_token ));

	// Return the lead info
	return $result->contacts[0]->id;
}

$lead_id = get_lead_id_by_email( $lead_email, $access_token );

/*
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
/**
 * Register hook function call.
 *
 * @param string $hookPoint The hook point to call
 * @param integer $priority The priority for the given hook function
 * @param string|function Function name to call or anonymous function.
 *
 * @return Depends on hook function point.
 */
 //add_hook('ClientAdd', 1, convert_lead_to_user($vars['email']));

