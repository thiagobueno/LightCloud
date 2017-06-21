<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class ApiController extends Controller
{
  public function __construct(){
    new Api();
    $this->middleware('InstallMiddleware');
  }

  public function getUsers()
  {
    if(User::hasPermission('api_get_users')){
      $users = new User();
      $users = $users->loadAll();
      echo json_encode($users->fetchAll());
    }else{
      header("HTTP/1.1 401 Unauthorized");
      exit;
    }
  }

  public function getFiles()
  {
    if(User::hasPermission('api_get_files')){
      $files = new File();
      $files = $files->loadAll();
      echo json_encode($files->fetchAll());
    }else{
      header("HTTP/1.1 401 Unauthorized");
      exit;
    }
  }

  public function getGroups()
  {
    if(User::hasPermission('api_get_groups')){
      $groups = new Group();
      $groups = $groups->loadAll();
      echo json_encode($groups->fetchAll());
    }else{
      header("HTTP/1.1 401 Unauthorized");
      exit;
    }
  }

}
