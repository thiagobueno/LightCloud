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
    $router->get('/api/users/get', 'ApiController@getUsers');
    $router->get('/api/files/get', 'ApiController@getFiles');
    $router->get('/api/groups/get', 'ApiController@getGroups');
  }




}
