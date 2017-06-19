<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

$router->get('/', 'HomeController@home');

/** Files **/
$router->get('/files', 'FilesController@home');
$router->post('/files/upload', 'FilesController@upload');
$router->post('/files/delete', 'FilesController@delete');
$router->post('/files/public', 'FilesController@public_');
$router->post('/files/private', 'FilesController@private_');

/** User **/
$router->get('/profile', 'HomeController@profile');
$router->get('/settings', 'HomeController@settings');
$router->post('/user/update', 'HomeController@updateUser');

/** Notifications **/
$router->get('/notifications', 'NotificationsController@home');
$router->get('/notifications/(\d+)', 'NotificationsController@notif');
$router->post('/notifications/delete', 'NotificationsController@delete');

/** Auth **/
Auth::routes($router);

/** Tests **/
$router->get('/test', function(){
  $notif = new Notification();
  $notif->add([
    'title' => 'test',
    'content' => 'Ceci est un autre test',
    'icon' => 'fa fa-test',
    'email' => 'contact@roch-blondiaux.com'
  ]);
});
