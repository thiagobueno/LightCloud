<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class AuthController extends Controller
{
  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views/auth');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('UnauthMiddleware');
    $this->middleware('InstallMiddleware');
  }

  public function login()
  {
    echo $this->templates->render('login');
  }

  public function login_()
  {
    Auth::login($_POST['email'], $_POST['password']);
  }

  public function register()
  {
    Auth::register($_POST['username'], $_POST['email'], $_POST['password']);
  }

  public function logout()
  {
    Auth::logout();
  }

}
