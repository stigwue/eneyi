<?php

require_once(__DIR__ . '/vendor/autoload.php');

use GuzzleHttp\Client;

//the purpose is to receive requests with METHOD, URL AND DATA,
//make the request and return the response

$method = (isset($_REQUEST['method']) ? $_REQUEST['method'] : 'POST');
$url = (isset($_REQUEST['url']) ? $_REQUEST['url'] : null);
$data = (isset($_REQUEST['data']) ? $_REQUEST['data'] : null);

$auth = (isset($_REQUEST['auth']) ? $_REQUEST['auth'] : null);
$headers = (isset($_REQUEST['headers']) ? $_REQUEST['headers'] : null);

//var_dump(compact('method', 'url', 'data'));

if (!is_null($url))
{
  $client = new Client();
  $response = null;

  $request = array(
    'parameter' => '',
    'data' => $data,
    //'auth'
  );

  switch ($method)
  {
    //PUT
    //DELETE

    case 'POST':
      $request['parameter'] = 'form_params';
    break;

    default: //GET
      $request['parameter'] = 'query';
    break;
  }


  try
  {
    $response = $client->request($method, $url,
      [
        $request['parameter'] => $request['data'],

      ]
    );
  }
  catch (Exception $e)
  {
    $response = null;
  }
}

if (!is_null($response))
{
  echo ((string) $response->getBody());
}
else
{
  echo ('{}');
}


?>
