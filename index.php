<?php

  require_once(__DIR__ . '/config.php');
  require_once(__DIR__ . '/vendor/autoload.php');

  use GuzzleHttp\Client;

  $client = new Client();
  $response = null;

  $request = array(
    'parameter' => '',
    'data' => $data,
    //'auth'
    //headers
    'url' => BASE_URL + $url
  );

  switch ($method)
  {
    //DELETE

    case 'POST':
      $request['parameter'] = 'form_params';
    break;

    /*case 'PUT':
    break;*/

    default: //GET
      $request['parameter'] = 'query';
    break;
  }

  //debug
  //var_dump(compact('url', 'method', 'data'));

  try
  {
    $response = $client->request($method, $request['url'],
      [
        $request['parameter'] => $request['data'],
        //'auth'
        //'headers'
      ]
    );
  }
  catch (Exception $e)
  {
    $response = null;
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
