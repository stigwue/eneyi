<?php

require_once(__DIR__ . '/config.php');

require_once(__DIR__ . '/eneyi.php');

//initialize
$destination = eneyi\eneyi::initialize();

//headers
$headers = eneyi\eneyi::parse_headers();

//parse
$parameters = eneyi\eneyi::parse_parameters();

//forward on
$response = null;
$response = eneyi\eneyi::make_request($parameters, $headers);


if (eneyi\eneyi::get_parameters()['debug'])
{
    var_dump(compact('destination', 'headers', 'parameters', 'response'));
}

echo $response;

?>
