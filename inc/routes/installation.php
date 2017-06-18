<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

/** GET **/
$router->get('/installation', 'InstallationController@home');
$router->get('/installation/config', 'InstallationController@config');
$router->get('/installation/database', 'InstallationController@database');
$router->get('/installation/user', 'InstallationController@user');
$router->get('/installation/finish', 'InstallationController@finish');

/** POST **/
$router->post('/installation/config', 'InstallationController@app');
$router->post('/installation/database', 'InstallationController@database_');
$router->post('/installation/user', 'InstallationController@user_');
$router->post('/installation/finish', 'InstallationController@finish_');
