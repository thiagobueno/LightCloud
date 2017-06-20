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
    $users = new User();
    $users = $users->loadAll();
    echo json_encode($users->fetchAll());
  }

  public function getFiles()
  {
    $files = new File();
    $files = $files->loadAll();
    echo json_encode($files->fetchAll());
  }

  public function getGroups()
  {
    $groups = new Group();
    $groups = $groups->loadAll();
    echo json_encode($groups->fetchAll());
  }

}
