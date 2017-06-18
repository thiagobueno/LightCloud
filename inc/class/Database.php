<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Database
{
  public $connection = null;
  public static $instance = null;

  private function __construct(){
    $this->connect();
  }

  public static function instance(){
    if (Database::$instance === null){
      Database::$instance = new self();
    }
     return Database::$instance->connection;
   }

  public function connect(){
    $db = require_once __DIR__ . '/../../config/database.php';

    define('DB_HOST', $db['host']);
    define('DB_NAME', $db['name']);
    define('DB_PORT', $db['port']);
    define('DB_CHARSET', $db['charset']);
    define('DB_USER', $db['user']);
    define('DB_PASSWORD', $db['password']);

    try
    {
      $this->connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.';charset='.DB_CHARSET.';', DB_USER, DB_PASSWORD,
        array(
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
      );
    }
    catch (Exception $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
  }
}
