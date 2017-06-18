<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class HomeController extends Controller
{

  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('AuthMiddleware');
    $this->middleware('InstallMiddleware');
  }

  public function home()
  {
    echo $this->templates->render('home');
  }

}
