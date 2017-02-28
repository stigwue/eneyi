<?php

namespace eneyi;

require_once(__DIR__ . '/vendor/autoload.php');

require_once(__DIR__ . '/eneyi.php');

use GuzzleHttp\Client;

class eneyi
{
  private static $_parameters = null;

  //stackoverflow, saving lives since 1960
  //http://stackoverflow.com/a/834355/3323338
  private static function startsWith($haystack, $needle)
  {
       $length = strlen($needle);
       return (substr($haystack, 0, $length) === $needle);
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
      'method' => (isset($_REQUEST['__method']) ? $_REQUEST['__method'] : $_SERVER['REQUEST_METHOD']),
      'url' => BASE_URL . (isset($_REQUEST['__url']) ? $_REQUEST['__url'] : ''),
      'auth' => (isset($_REQUEST['__auth']) ? $_REQUEST['__auth'] : null),
      'headers' => (isset($_REQUEST['__headers']) ? $_REQUEST['__headers'] : null),

      'debug' => (isset($_REQUEST['__debug'])),
      'destination' => '',
      'parameters' => array(),
      'response' => null,

    );

    Self::$_parameters['destination'] = Self::$_parameters['url'];

    return Self::$_parameters['url'];

  }

  public static function parse_parameters()
  {
    $params_to = null;
    $params_from = null;

    //pick data
    switch (strtolower(Self::$_parameters['method']))
    {
      case 'post':
        //loop through $_POST, drop all __* data
        $params_to = array();
        $params_from = &$_POST;
      break;

      /*
      case 'put':
        parse_str(file_get_contents("php://input"), $params_from);
      break;

      case 'delete':
        //handle some way?
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

  public static function make_request(&$params_to)
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
