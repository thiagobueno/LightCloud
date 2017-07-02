<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

/** GET **/
$router->get('/admin', 'AdminController@home');
$router->get('/admin/files', 'AdminController@files');
$router->get('/admin/users', 'AdminController@users');
$router->get('/admin/groups', 'AdminController@groups');
$router->get('/admin/groups/edit/(\d+)', 'AdminController@editGroup');
$router->get('/admin/settings', 'AdminController@settings');

/** POST **/
$router->post('/admin/app/update', 'AdminController@updateApp');
$router->post('/admin/database/update', 'AdminController@updateDatabase');
$router->post('/admin/groups/edit', 'AdminController@editGroup_');
