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

    $this->pdo = Database::instance();
  }

  public function home()
  {
    echo $this->templates->render('home');
  }

  public function profile()
  {
    echo $this->templates->render('profile');
  }

  public function settings()
  {
    echo $this->templates->render('settings');
  }

  public function updateUser()
  {
    if(!empty($_POST['name']) && !empty($_POST['email']))
    {
      $query = $this->pdo->prepare('UPDATE users SET username=:username, email=:email WHERE ID=:ID');
      if($query->execute([
        'username' => $_POST['name'],
        'email' => $_POST['email'],
        'ID' => $_SESSION['ID']
      ])){
        $_SESSION['username'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];

        $alert = new Alert('SUCCESS', 'Your account has been updated successfully !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/settings');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While updating your account !', 'fa fa-close', 'danger');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }

}
