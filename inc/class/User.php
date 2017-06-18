<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class User extends Entity
{

  protected $table = 'users';

  public function setFields()
  {
    $this->fields = [
    'ID' => 'int',
    'username' => 'string',
    'email' => 'string',
    'password' => 'string',
    'rank' => 'int',
    'created_at' => 'timestamp',
    'updated_at' => 'timestamp'
  ];
  }
}
