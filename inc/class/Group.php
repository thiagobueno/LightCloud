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
  private $upload_files;
  private $read_files;
  private $download_files;
  private $admin;

  public function getByID($ID)
  {
    $data = $this->load(['ID' => $ID])->fetch();
    $this->setID($data['ID']);
    $this->setName($data['name']);
    $this->setUploadFiles($data['upload_files']);
    $this->setReadFiles($data['read_files']);
    $this->setDownloadFiles($data['download_files']);
    $this->setAdmin($data['admin']);
  }

  public function setFields()
  {

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
     * Get the value of Upload Files
     *
     * @return mixed
     */
    public function getUploadFiles()
    {
        return $this->upload_files;
    }

    /**
     * Set the value of Upload Files
     *
     * @param mixed upload_files
     *
     * @return self
     */
    public function setUploadFiles($upload_files)
    {
        $this->upload_files = $upload_files;

        return $this;
    }

    /**
     * Get the value of Read Files
     *
     * @return mixed
     */
    public function getReadFiles()
    {
        return $this->read_files;
    }

    /**
     * Set the value of Read Files
     *
     * @param mixed read_files
     *
     * @return self
     */
    public function setReadFiles($read_files)
    {
        $this->read_files = $read_files;

        return $this;
    }

    /**
     * Get the value of Download Files
     *
     * @return mixed
     */
    public function getDownloadFiles()
    {
        return $this->download_files;
    }

    /**
     * Set the value of Download Files
     *
     * @param mixed download_files
     *
     * @return self
     */
    public function setDownloadFiles($download_files)
    {
        $this->download_files = $download_files;

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
