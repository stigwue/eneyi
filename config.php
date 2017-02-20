<?php

  const BASE_URL = 'http://foo.bar/';

  $method = $_SERVER['REQUEST_METHOD'];
  $url = (isset($_REQUEST['url']) ? $_REQUEST['url'] : '');
  //$auth = (isset($_REQUEST['auth']) ? $_REQUEST['auth'] : null);
  //$headers = (isset($_REQUEST['headers']) ? $_REQUEST['headers'] : null);
  $data = null;

  //pick data
  switch ($method)
  {
    case 'POST':
      $data = $_POST;
    break;

    /*case 'PUT':
      parse_str(file_get_contents("php://input"), $data);
    break;*/

    default: //GET
      $data = $_GET;
    break;
  }



?>
