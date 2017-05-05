<?php

function config() {
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