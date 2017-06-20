<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Group extends Entity
{
  protected $table = 'groups';

  private $name;
  private $admin;

  public function getByID($ID)
  {
    $data = $this->load(['ID' => $ID])->fetch();
    $this->setID($data['ID']);
    $this->setName($data['name']);
    $this->setAdmin($data['admin']);
  }

  public function hasPermission($perm)
  {
    $p = new Permission();
    $p->getByName($perm);
    if($p->hasAccess($perm, $this->getID()))
      return true;
    else
      return false;
  }


    /**
     * Get the value of Light Cloud © 2017
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Light Cloud © 2017
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Admin
     *
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of Admin
     *
     * @param mixed admin
     *
     * @return self
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

}
