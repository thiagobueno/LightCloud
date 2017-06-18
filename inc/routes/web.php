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

/** Auth **/
Auth::routes($router);
