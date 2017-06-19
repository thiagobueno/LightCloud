<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Auth
{

  public static function isActive()
  {
    if(!empty($_SESSION['ID']))
      return true;
    else
      return false;
  }

  public static function routes($router)
  {
    $router->get('/logout', 'AuthController@logout');
    $router->get('/login', 'AuthController@login');
    $router->post('/login', 'AuthController@login_');
    $router->post('/register', 'AuthController@register');
  }

  public static function hash($password)
  {
    $salt1 = SALT_1;
    $salt2 = SALT_2;
    return bin2hex($salt1.hash('sha1', $password) . hash('sha512', $password) . hash('sha256', $password).$salt2);
  }

  public static function logout()
  {
      session_destroy();
      header('Location: ' . APP_URL . '/login');
  }

  public static function login($email, $password)
  {
    if(!empty($email) && !empty($password))
    {
      $query = Database::instance()->prepare('SELECT * FROM users WHERE email=:email AND password=:password');
      $query->execute([
        'email' => $email,
        'password' => Auth::hash($password)
      ]);

      if($query->rowCount() == 1)
      {
        $data = $query->fetch();

        $_SESSION['ID'] = $data['ID'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['rank'] = $data['rank'];
        $_SESSION['created_at'] = $data['created_at'];
        $_SESSION['updated_at'] = $data['updated_at'];

        $alert = new Alert('SUCCESS', 'You\'re logged in !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(5, APP_URL . '/');
        echo $alert->render();
      }else{
        $notif = new Notification();
        $notif->add([
          'title' => 'Log in failed',
          'content' => 'The following IP ' . User::getIp() . ' tried to connect to your account without success.',
          'icon' => 'fa fa-lock',
          'email' => $_POST['email']
        ]);

        $alert = new Alert('ERROR', 'Please check your email and your password !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Please complete all inputs in the login form !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

  public static function register($username, $email, $password)
  {
    if(!empty($username) && !empty($email) && !empty($password))
    {
      $query = Database::instance()->prepare('SELECT * FROM users WHERE email=:email OR username=:username');
      $query->execute([
        'email' => $email,
        'username' => $username
      ]);

      if($query->rowCount() == 0)
      {
        $query = Database::instance()->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');

        if($query->execute([
          'email' => $email,
          'username' => $username,
          'password' => Auth::hash($password)
        ]))
        {
          $notif = new Notification();
          $notif->add([
            'title' => 'Complete registration',
            'content' => 'Welcome to ' . APP_NAME . ', thank you for registering, enjoy',
            'icon' => 'fa fa-check-circle',
            'email' => $_POST['email']
          ]);

          $alert = new Alert('SUCCESS', 'Your account has been registered !', 'fa fa-check-circle', 'success');
          $alert->setRedirection(5, APP_URL . '/login');
          echo $alert->render();
        }else{
          $alert = new Alert('ERROR', 'While registering your account, please retry !', 'fa fa-close', 'error');
          echo $alert->render();
        }
      }else{
        $alert = new Alert('ERROR', 'Another account is already registered with your username or with your email !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Please complete all inputs in the register form !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }
}
