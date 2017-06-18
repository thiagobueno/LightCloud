<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class AdminController extends Controller
{

  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views/admin');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('AuthMiddleware');
    $this->middleware('AdminMiddleware');
    $this->middleware('InstallMiddleware');
  }

  public function admin()
  {
    echo $this->templates->render('home');
  }

  public function files()
  {
    echo $this->templates->render('files');
  }

}
