<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class NotificationsController extends Controller
{

  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views/notifications/');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('AuthMiddleware');
    $this->middleware('InstallMiddleware');

    $this->pdo = Database::instance();
  }

  public function home()
  {
    echo $this->templates->render('home');
  }

  public function notif($id)
  {
    define('NOTIFICATION_ID', $id);
    echo $this->templates->render('solo');
  }

  public function delete()
  {
    if(!empty($_POST['ID']))
    {
      $query = $this->pdo->prepare('DELETE FROM notifications WHERE ID=:ID');
      if($query->execute([
        'ID' => $_POST['ID']
      ]))
      {
        echo '<script>$("#tr-' . $_POST['ID'] . '").fadeOut();</script>';
        $alert = new Alert('SUCCESS', 'This notification has been deleted successfuly !', 'fa fa-check-circle', 'success');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While deleting your notification !', 'fa fa-close', 'danger');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }
}
