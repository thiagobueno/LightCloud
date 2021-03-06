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

  public function home()
  {
    if(User::hasPermission('admin_home'))
      echo $this->templates->render('home');
  }

  public function files()
  {
    if(User::hasPermission('admin_files'))
      echo $this->templates->render('files');
  }

  public function settings()
  {
    if(User::hasPermission('admin_settings'))
      echo $this->templates->render('settings');
  }

  public function users()
  {
    if(User::hasPermission('admin_users'))
    echo $this->templates->render('users');
  }

  public function groups()
  {
    if(User::hasPermission('admin_groups'))
    echo $this->templates->render('groups');
  }

  public function editGroup($ID)
  {
    define('GROUP_ID', $ID);

    if(User::hasPermission('admin_edit_groups'))
    echo $this->templates->render('editGroup');
  }

  public function editGroup_()
  {
    if(!empty($_POST['ID']) && !empty($_POST['name']) && $_POST['admin'] != null)
    {
      $query = Database::instance()->prepare('UPDATE groups SET name=:name, admin=:admin WHERE ID=:ID');
      if($query->execute([
        'name' => $_POST['name'],
        'admin' => $_POST['admin'],
        'ID' => $_POST['ID']
      ]))
      {
        $alert = new Alert('SUCCESS', 'The group has been updated successfully', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/admin/groups/edit/' . $_POST['ID']);
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While updating group !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

  public function updateApp()
  {
    if(!empty($_POST['name']) && !empty($_POST['url']))
    {
      $search  = array(APP_URL, APP_NAME);
      $replace = array($_POST['url'], $_POST['name']);
      $file = file_get_contents(__DIR__ . '/../../config/app.php');
      $file = str_replace($search, $replace, $file);
      if(file_put_contents(__DIR__ . '/../../config/app.php', $file))
      {
        $alert = new Alert('SUCCESS', 'The configuration of your application has been saved successfully !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/admin/settings');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'Please make sure that the file <code>storage/config/app.php</code> have <code>644</code> permissions !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

  public function updateDatabase()
  {
    if(!empty($_POST['host']) && !empty($_POST['name']) && !empty($_POST['charset']) && !empty($_POST['port']) && !empty($_POST['user']))
    {
      if(empty($_POST['password'])) $_POST['password'] = '';

      $search  = array(DB_HOST, DB_NAME, DB_CHARSET, DB_PORT, DB_USER, DB_PASSWORD);
      $replace = array($_POST['host'], $_POST['name'], $_POST['charset'], $_POST['port'], $_POST['user'], $_POST['password']);
      $file = file_get_contents(__DIR__ . '/../../config/database.php');
      $file = str_replace($search, $replace, $file);
      if(file_put_contents(__DIR__ . '/../../config/database.php', $file))
      {
        $alert = new Alert('SUCCESS', 'The configuration of your database has been saved successfully !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/admin/settings');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'Please make sure that the file <code>storage/config/database.php</code> have <code>644</code> permissions !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

  public function addPermission()
  {
    if(!empty($_POST['ID']) && !empty($_POST['permission']))
    {
      $p = new Permission();
      if($p->add([
        'name' => $_POST['permission'],
        'group_ID' => $_POST['ID'],
        'value' => 1
      ])){
        $alert = new Alert('SUCCESS', 'The permission has been added successfully !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/admin/groups/edit/' . $_POST['ID']);
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

  public function deletePermission()
  {
    if(!empty($_POST['ID']) && !empty($_POST['permission']))
    {
      $query = Database::instance()->prepare('DELETE FROM permissions WHERE name=:name AND group_ID=:ID');
      if($query->execute([
        'name' => $_POST['permission'],
        'ID' => $_POST['ID']
        ])){
        $alert = new Alert('SUCCESS', 'The permission has been deleted successfully !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/admin/groups/edit/' . $_POST['ID']);
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While deleting permission !', 'fa fa-close', 'error');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'error');
      echo $alert->render();
    }
  }

}
