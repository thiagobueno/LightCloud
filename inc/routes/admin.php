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

/** POST **/
