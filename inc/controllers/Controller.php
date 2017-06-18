<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

abstract class Controller
{

  protected function middleware($name)
  {
    $middleware = new $name();
    $middleware->handle();
  }
}
