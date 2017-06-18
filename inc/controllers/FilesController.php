<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class FilesController extends Controller
{

  public function __construct(){
    $this->templates = new League\Plates\Engine('inc/views/files');
    $this->templates->addFolder('layouts', 'inc/views/layouts/');

    $this->middleware('AuthMiddleware');
    $this->middleware('InstallMiddleware');

    $this->pdo = Database::instance();
  }

  public function home()
  {
    echo $this->templates->render('home');
  }

  public function upload()
  {
    $FileUploader = new FileUploader('files', array(
        'uploadDir' => __DIR__  . '/../../storage/uploads/',
        'title' => 'auto',
    ));
    $data = $FileUploader->upload();

    echo json_encode($data);
    exit;
  }

  public function public_()
  {
    if(!empty($_POST['file']))
    {
      $query = $this->pdo->prepare('UPDATE files SET public=:public WHERE ID=:ID');
      if($query->execute([
        'public' => 1,
        'ID' => $_POST['file']
      ])){
        $alert = new Alert('SUCCCESS', 'The file has been updated successfuly !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/files');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While updating the file !', 'fa fa-close', 'danger');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }

  public function private_()
  {
    if(!empty($_POST['file']))
    {
      $query = $this->pdo->prepare('UPDATE files SET public=:public WHERE ID=:ID');
      if($query->execute([
        'public' => 0,
        'ID' => $_POST['file']
      ])){
        $alert = new Alert('SUCCCESS', 'The file has been updated successfuly !', 'fa fa-check-circle', 'success');
        $alert->setRedirection(3, APP_URL . '/files');
        echo $alert->render();
      }else{
        $alert = new Alert('ERROR', 'While updating the file !', 'fa fa-close', 'danger');
        echo $alert->render();
      }
    }else{
      $alert = new Alert('ERROR', 'Missing arguments !', 'fa fa-close', 'danger');
      echo $alert->render();
    }
  }

  public function delete()
  {
    if (isset($_POST['file'])) {
        $file = __DIR__  . '/../../storage/uploads/' . $_POST['file'];

        $query = $this->pdo->prepare('DELETE FROM files WHERE temp=:temp');
        $query->execute([
          'temp' => $_POST['file']
        ]);


        if(file_exists($file))
    		unlink($file);
    }
  }



}
