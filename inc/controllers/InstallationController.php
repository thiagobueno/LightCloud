<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class InstallationController extends Controller
{

  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views/installation');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('InstalledMiddleware');
  }

  public function home()
  {
    echo $this->templates->render('home');
  }

  public function config()
  {
    echo $this->templates->render('app');
  }

  public function app()
  {
    if(!empty($_POST['url']) && !empty($_POST['name']))
    {
      if(file_exists(__DIR__ . '/../../storage/config/app.php'))
      {
        if(file_exists(__DIR__ . '/../../config/app.php')){
          unlink(__DIR__ . '/../../config/app.php');
        }

        copy(__DIR__ . '/../../storage/config/app.php', __DIR__ . '/../../config/app.php');
        $search  = array('%url%', '%name%', '%salt1%', '%salt2%');
        $replace = array($_POST['url'], $_POST['name'], $this->generateSalt(25), $this->generateSalt(25));
        $file = file_get_contents(__DIR__ . '/../../config/app.php');
        $file = str_replace($search, $replace, $file);
        if(file_put_contents(__DIR__ . '/../../config/app.php', $file))
        {
          $alert = new Alert('SUCCESS', 'The configuration of your application has been saved successfully !', 'fa fa-check-circle', 'success');
          $alert->setRedirection(5, APP_URL . '/installation/database');
          echo $alert->render();
          exit(0);
        }else{
          $alert = new Alert('ERROR', 'Please make sure that the file <code>storage/config/app.php</code> have <code>644</code> permissions !', 'fa fa-close', 'danger');
          echo $alert->render();
          exit(0);
        }
      }else{
        $alert = new Alert('ERROR', 'Please make sure the file <code>storage/config/app.php</code> exists !', 'fa fa-close', 'danger');
        echo $alert->render();
        exit(0);
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }

  public function database()
  {
    echo $this->templates->render('database');
  }

  public function database_()
  {
    if(!empty($_POST['host']) && !empty($_POST['charset']) && !empty($_POST['port']) && !empty($_POST['name']) && !empty($_POST['user']))
    {
      if(empty($_POST['password'])) $_POST['password'] = '';

      try
      {
        $this->connection = new PDO("mysql:host=".$_POST['host'].";dbname=".$_POST['name'].";port=".$_POST['port'].';charset='.$_POST['charset'].';', $_POST['user'], $_POST['password'],
          array(
          PDO::ATTR_TIMEOUT => 5,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          )
        );
      }
      catch (Exception $e) {
        $alert = new Alert('ERROR', $e->getMessage(), 'fa fa-close', 'warning');
        echo $alert->render();
        exit(0);
      }


      if(file_exists(__DIR__ . '/../../storage/config/database.php'))
      {
        if(file_exists(__DIR__ . '/../../config/database.php')){
          unlink(__DIR__ . '/../../config/database.php');
        }

        copy(__DIR__ . '/../../storage/config/database.php', __DIR__ . '/../../config/database.php');
        $search  = array('%host%', '%charset%', '%port%', '%user%', '%password%', '%name%');
        $replace = array($_POST['host'], $_POST['charset'], $_POST['port'], $_POST['user'], $_POST['password'], $_POST['name']);
        $file = file_get_contents(__DIR__ . '/../../config/database.php');
        $file = str_replace($search, $replace, $file);
        if(file_put_contents(__DIR__ . '/../../config/database.php', $file))
        {
          $alert = new Alert('SUCCESS', 'The configuration of your database has been saved successfully !', 'fa fa-check-circle', 'success');
          $alert->setRedirection(5, APP_URL . '/installation/user');
          echo $alert->render();
          exit(0);
        }else{
          $alert = new Alert('ERROR', 'Please make sure that the file <code>storage/config/database.php</code> have <code>644</code> permissions !', 'fa fa-close', 'danger');
          echo $alert->render();
          exit(0);
        }
      }else{
        $alert = new Alert('ERROR', 'Please make sure the file <code>storage/config/database.php</code> exists !', 'fa fa-close', 'danger');
        echo $alert->render();
        exit(0);
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }

  public function user()
  {
    echo $this->templates->render('user');
  }

  public function user_()
  {
    $query = Database::instance()->prepare('INSERT INTO users (username, email, password, rank) VALUES (:username, :email, :password, :rank)');
    $query->execute([
      'email' => $_POST['email'],
      'username' => $_POST['username'],
      'password' => Auth::hash($_POST['password']),
      'rank' => 1
    ]);

    $alert = new Alert('SUCCESS', 'The user has been created successfuly !', 'fa fa-check-circle', 'success');
    $alert->setRedirection(5, APP_URL . '/installation/finish');
    echo $alert->render();
    exit(0);
  }

  public function finish()
  {
    echo $this->templates->render('finish');
  }

  public function finish_()
  {
    file_put_contents(__DIR__ . '/../../storage/installed', 'Nothing here :)');
    $alert = new Alert('SUCCESS', 'Nothing', 'fa fa-check-circle', 'success');
    $alert->setRedirection(0.001, APP_URL . '/');
    echo $alert->render();
    exit(0);
  }

  private function generateSalt($lenght, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789')
  {
    $token = null;
    $nb_lettres = strlen($chaine) - 1;
    for($i=0; $i < $lenght; $i++)
    {
      $pos = mt_rand(0, $nb_lettres);
      $car = $chaine[$pos];
      $token .= $car;
    }
    return $token;
  }
}
