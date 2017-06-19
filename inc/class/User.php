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
  private $username;
  private $email;
  private $rank;
  private $created_at;
  private $updated_at;

  public function setup($ID)
  {
    $data = $this->load(['ID' => $ID])->fetch();
    $this->setID($data['ID']);
    $this->setUsername($data['username']);
    $this->setEmail($data['email']);
    $this->setRank($data['rank']);
    $this->setCreatedAt($data['created_at']);
    $this->setUpdatedAt($data['updated_at']);

    $group = new Group();
    $group->getByID($data['rank']);
    $this->closeDatabase();
    $_SESSION['user'] = json_encode([
      'ID' => $this->getID(),
      'username' => $this->getUsername(),
      'email' => $this->getEmail(),
      'rank' => $this->getRank(),
      'created_at' => $this->getCreatedAt(),
      'updated_at' => $this->getUpdatedAt(),
      'group_ID' => $group->getID(),
      'group_name' => $group->getName(),
      'group_upload_files' => $group->getUploadFiles(),
      'group_read_files' => $group->getReadFiles(),
      'group_download_files' => $group->getDownloadFiles(),
      'group_admin' => $group->getAdmin()
    ]);
  }

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

  public static function getIP() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  public static function getUserData()
  {
    return json_decode($_SESSION['user']);
  }

  public static function isAdmin()
  {
    if(User::getUserData()->group_admin == 1)
      return true;
    else
      return false;
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
     * Get the value of Username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of Username
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Rank
     *
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set the value of Rank
     *
     * @param mixed rank
     *
     * @return self
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get the value of Created At
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of Created At
     *
     * @param mixed created_at
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of Updated At
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of Updated At
     *
     * @param mixed updated_at
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

}
