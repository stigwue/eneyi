<?php

  require_once(__DIR__ . '/config.php');

  require_once(__DIR__ . '/eneyi.php');

  //initialize
  $destination = eneyi\eneyi::initialize();

  //parse
  $parameters = eneyi\eneyi::parse_parameters();

  //forward on
  $response = eneyi\eneyi::make_request($parameters);


  if (eneyi\eneyi::get_parameters()['debug'])
  {
    var_dump(compact('destination', 'parameters', 'response'));
  }

  echo $response;

?>
