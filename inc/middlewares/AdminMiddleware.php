<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class AdminMiddleware extends Middleware
{

  public function handle()
  {
    if($_SESSION['rank'] < 2)
      header('Location: ' . APP_URL . '/');
  }
}
