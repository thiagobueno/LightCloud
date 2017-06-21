<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Api
{

  public function __construct()
  {
    //Auth

  }

  public static function routes($router)
  {
    $router->post('/api/users/get', 'ApiController@getUsers');
    $router->post('/api/files/get', 'ApiController@getFiles');
    $router->post('/api/groups/get', 'ApiController@getGroups');
  }




}
