<?php

function whmcs_convert_intercomio_lead_config() {
  $configarray = array(
  "name" => "WHMCS Convert Intercom.io Lead to User",
  "description" => "This small WHMCS addon allows you the ability to convert an Intercom.io lead into a user by utilizing the ClientAdd hook from WHMCS.",
  "version" => "1.0",
  "author" => "Eric Baker <eric@ericbaker.me>",
  "fields" => array(
      "option1" => array ("Access Token" => "Option1", "Type" => "text", "Size" => "60",
                            "Description" => "Your Intercom.io Access Token", "Default" => "", ),
  ));
  return $configarray;
}

function whmcs_convert_intercomio_lead_activate() {
  return array( 
    'status' => 'success', 
    'description' => 'Make sure to enter your Access Token in the settings page in order to start converting your new WHMCS clients within Intercom.io.'
  );
}

function whmcs_convert_intercomio_lead_deactivate() {
  // Remove the database entry for the access token.
  $query = "DELETE FROM  `tbladdonmodules` WHERE  `module` =  'whmcs_convert_intercomio_lead'";
  $result = full_query($query);

  // Return result
  return array(
    'status' => 'success',
    'description' => 'The module has been deactivated.'
  );
}

function whmcs_convert_intercomio_lead_output($vars) {
  $option1 = $vars['option1'];

  
}