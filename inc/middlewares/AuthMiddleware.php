<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class AuthMiddleware extends Middleware
{

  public function handle()
  {
    if(!Auth::isActive())
      header('Location: ' . APP_URL . '/login');
  }
}
