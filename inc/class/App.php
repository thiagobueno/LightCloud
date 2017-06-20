<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class App
{

  public function __construct()
  {
    session_start();

    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/Autoloader.php';

    $this->loadConfig();
    $this->loadClass();
    if(App::isInstalled())
      $this->loadDatabase();
    $this->loadMiddlewares();
    $this->loadControllers();
    $this->loadRoutes();
  }

  private function loadConfig()
  {
    if(!App::isInstalled() && !file_exists(__DIR__ . '/../../config/app.php'))
    {
      define('APP_URL', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]");
    }else{
      $app = require_once __DIR__ . '/../../config/app.php';

      define('APP_URL', $app['url']);
      define('APP_NAME', $app['name']);
      define('APP_VERSION', $app['version']);
      define('SALT_1', $app['salt1']);
      define('SALT_2', $app['salt2']);
    }
  }

  private function loadClass()
  {
    Autoloader::loadClass('Database');
    Autoloader::loadClass('Entity');
    Autoloader::loadClass('User');
    Autoloader::loadClass('Auth');
    Autoloader::loadClass('Alert');
    Autoloader::loadClass('File');
    Autoloader::loadClass('FileUploader');
    Autoloader::loadClass('Notification');
    Autoloader::loadClass('Group');
    Autoloader::loadClass('Permission');
  }

  private function loadDatabase()
  {
    Database::instance();
  }

  private function loadMiddlewares()
  {
    Autoloader::loadMiddleware('Middleware');
    Autoloader::loadMiddleware('InstallMiddleware');
    Autoloader::loadMiddleware('InstalledMiddleware');
    Autoloader::loadMiddleware('AuthMiddleware');
    Autoloader::loadMiddleware('UnauthMiddleware');
    Autoloader::loadMiddleware('AdminMiddleware');
    Autoloader::loadMiddleware('UserUpdateMiddleware');
  }

  private function loadControllers()
  {
    Autoloader::loadController('Controller');
    Autoloader::loadController('InstallationController');
    Autoloader::loadController('HomeController');
    Autoloader::loadController('AuthController');
    Autoloader::loadController('FilesController');
    Autoloader::loadController('AdminController');
    Autoloader::loadController('NotificationsController');
  }

  private function loadRoutes()
  {
    $router = new \Bramus\Router\Router();

    Autoloader::loadRoute('web', $router);
    Autoloader::loadRoute('admin', $router);
    Autoloader::loadRoute('installation', $router);

    $router->run();
  }

  public static function isInstalled()
  {
    if(file_exists(__DIR__ . '/../../storage/installed'))
      return true;
    else
      return false;
  }
}
