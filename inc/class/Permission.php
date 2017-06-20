<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Permission extends Entity
{

  protected $table = 'permissions';
  private $name;
  private $value;
  private $group_ID;

  public function hasAccess($perm, $group_ID)
  {
    if($this->getName() == $perm && $this->getValue() == 1 && $this->getGroupID() == $group_ID)
      return true;
    else
      return false;
  }

  public function getByID($ID)
  {
    $data = $this->load(['ID' => $ID])->fetch();
    $this->setID($data['ID']);
    $this->setName($data['name']);
    $this->setValue($data['value']);
    $this->setGroupID($data['group_ID']);
  }

  public function getByName($name)
  {
    $data = $this->load(['name' => $name])->fetch();
    $this->setID($data['ID']);
    $this->setName($data['name']);
    $this->setValue($data['value']);
    $this->setGroupID($data['group_ID']);
  }

    /**
     * Get the value of Light Cloud © 2017
     *
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of Light Cloud © 2017
     *
     * @param mixed table
     *
     * @return self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
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
     * Get the value of Value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of Value
     *
     * @param mixed value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }


    /**
     * Get the value of Group ID
     *
     * @return mixed
     */
    public function getGroupID()
    {
        return $this->group_ID;
    }

    /**
     * Set the value of Group ID
     *
     * @param mixed group_ID
     *
     * @return self
     */
    public function setGroupID($group_ID)
    {
        $this->group_ID = $group_ID;

        return $this;
    }

}
