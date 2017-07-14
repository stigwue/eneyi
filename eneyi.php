<?php

namespace eneyi;

require_once(__DIR__ . '/vendor/autoload.php');

require_once(__DIR__ . '/eneyi.php');

use GuzzleHttp\Client;

class eneyi
{
  private static $_headers = array();
  private static $_parameters = null;

  //stackoverflow, saving lives since 1960
  //http://stackoverflow.com/a/834355/3323338
  private static function startsWith($haystack, $needle)
  {
       $length = strlen($needle);
       return (substr($haystack, 0, $length) === $needle);
  }

  public static function get_headers()
  {
    return Self::$_headers;
  }

  public static function get_authorization()
  {
    return Self::$_parameters['authorization'];
  }

  public static function get_parameters()
  {
    return Self::$_parameters;
  }

  public static function initialize()
  {
    //note that Eneyi tries to deduce some parameters
    //from the request itself
    //if they are not explicitly provided by the user
    //using the __ prefix

    Self::$_parameters = array(
      'authorization' => BASE_URL . (isset($_REQUEST['__authorization']) ? $_REQUEST['__authorization'] : ''),
      'method' => (isset($_REQUEST['__method']) ? $_REQUEST['__method'] : $_SERVER['REQUEST_METHOD']),
      'url' => BASE_URL . (isset($_REQUEST['__url']) ? $_REQUEST['__url'] : ''),

      'debug' => (isset($_REQUEST['__debug'])),
      'destination' => '',
      'parameters' => array(),
      'response' => null,

    );

    Self::$_parameters['destination'] = Self::$_parameters['url'];

    return Self::$_parameters['url'];

  }

  public static function parse_headers()
  {
      Self::$_headers = getallheaders();
      
      return Self::$_headers;
  }

  public static function parse_parameters()
  {
    $params_to = null;
    $params_from = null;

    //pick data
    //now, there might be a bit of a problem
    //we may want to send a GET on but with POSTed data
    switch (strtolower(Self::$_parameters['method']))
    {
      case 'post':
        //loop through $_POST, drop all __* data
        $params_to = array();
        $params_from = &$_POST;
      break;

      /*
      case 'put':
        $params_to = array();
        //parse_str(file_get_contents("php://input"), $params_from);
        //var_dump($params_from);
      break;

      case 'delete':
        //handle some way?
        $params_to = array();
      break;
      */

      default: //get
        $params_to = array();
        $params_from = &$_GET;
      break;
    }

    foreach ($params_from as $key => $value)
    {
      if (Self::startsWith($key, '__'))
      {
        //drop, or use to modify Eneyi parameters
      }
      else
      {
        //forward on
        $params_to[$key] = $params_from[$key];
      }
    }

    Self::$_parameters['parameters'] = $params_to;
    return $params_to;
  }

  public static function make_request(&$params_to, &$headers_to = array())
  {
    switch (strtolower(Self::$_parameters['method']))
    {
      case 'post':
        $request['parameter'] = 'form_params';
      break;

      /*
      case 'put':
      break;

      case 'delete':
      break;
      */

      default: //GET
        $request['parameter'] = 'query';
      break;
    }


    $client = new Client();
    $response = null;

    try
    {
      $response = $client->request(Self::$_parameters['method'], Self::$_parameters['url'],
        [
          $request['parameter'] => $params_to,
          'headers' => $headers_to
          //'auth'
        ]
      );
    }
    catch (Exception $e)
    {
      $response = null;
    }

    if (!is_null($response))
    {
      Self::$_parameters['response'] = (string) $response->getBody();
      return Self::$_parameters['response'];
    }
    else
    {
      Self::$_parameters['response'] = '{}';
      return Self::$_parameters['response'];
    }
  }
}

?>
