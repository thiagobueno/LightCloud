<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Notification extends Entity
{
  protected $table = 'notifications';

  public function __construct()
  {
    $this->openDatabase();
  }


}
