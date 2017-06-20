<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

abstract class Entity
{
  protected $debug = true;
  protected $pdo;
  protected $table;
  private $ID;

  public function __construct()
  {
    $this->openDatabase();
  }

  public function closeDatabase()
  {
    $this->setPdo('');
  }

  public function openDatabase()
  {
    $this->setPdo(Database::instance());
  }

  /** SQL **/

  public function create()
  {
    $query_ = file_get_contents(__DIR__ . '/../../storage/tables/' . $this->table . '.sql');
    $query = $this->getPdo()->prepare($query_);

    if($this->debug == true) echo '[DEBUG] : REQUEST => ' . $query_;
    if(!$query->execute() && $this->debug == true) die('[DEBUG] : ERROR WHILE CREATING ' . $this->table . ' TABLE ON ' . get_class($this) . ' !');
  }

  public function add($fields)
  {
    $columns = '';
    $values = '';

    if(sizeof($fields) != 0){
      $i=false;
      foreach($fields as $column=>$value){
          if($i){$values .=', '; $columns .=', ';}else{$i=true;}
          $values .= "'" . $value . "'";
          $columns .= $column;
      }
    }elseif($this->getDebug() == true) die('[DEBUG] : ERROR WHILE ADDING OBJECT ON : ' . get_class($this));

    $query = 'INSERT INTO ' . $this->table . ' (' . $columns . ') VALUES (' . $values . ') ';
    $query = $this->getPdo()->prepare($query);
    if($query->execute()) return true;
    else return false;
  }

  public function drop()
  {
    $query = 'DROP TABLE `' . $this->table . '`;';
    $query = $this->getPdo()->prepare($query);

    if($this->debug == true) echo '[DEBUG] : REQUEST => ' . $query;
    if(!$query->execute() && $this->debug == true) die('[DEBUG] : ERROR WHILE DROPING ' . $this->table . ' TABLE ON ' . get_class($this) . ' !');
  }

  public function loadAll()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $query = $this->getPdo()->prepare($query);
    if($query->execute())
      return $query;
    elseif($this->getDebug()) die('[DEBUG] : ERROR WHILE LOADING OBJECTS ON : ' . get_class($this));
  }

  public function load($columns)
  {
    $where = ' WHERE ';

    if($columns!=null && sizeof($columns)!=0){
      $i=false;
      foreach($columns as $column=>$value){
					if($i){$where .=' AND ';}else{$i=true;}
					$where .= '`'.$column.'`="'.$value.'"';
				}
    }

    $query = 'SELECT * FROM ' . $this->table . ' ' . $where;
    $query = $this->getPdo()->prepare($query);
    if($query->execute())
      return $query;
    elseif($this->getDebug()) die('[DEBUG] : ERROR WHILE LOADING OBJECTS ON : ' . get_class($this));
  }

  public function findOrFail($id)
  {
    return $this->load(['ID' => $id]);
  }

  public function count($columns)
  {
    $where = ' WHERE ';

		if($columns!=null){
			$i=false;
			foreach($columns as $column=>$value){
					if($i){$where .=' AND ';}else{$i=true;}
					$where .= '`'.$column.'`="'.$value.'"';
			}
		}
		$query = 'SELECT * FROM ' . $this->table . $where;
		$query = $this->getPdo()->prepare($query);
		$query->execute();

    return $query->rowCount();
  }

  public function customQuery($sql)
  {
    $query = $this->getPdo()->prepare($sql);

    return $query->execute();
  }

  public function checkTable()
  {
    $query = 'SELECT count(*) as numRows FROM sqlite_master WHERE type="table" AND name="'.$this->table.'"';
    $query = $this->getPdo()->prepare($query);
    $return = $query->execute();

    if($return != false)
    {
      $return = $return->fetch();
      if($return['numRows'] == 1){
				$return = true;
			}
    }

    if(!$return) $this->create;

    return $return;
  }


      /**
       * Get the value of ID
       *
       * @return mixed
       */
      public function getID()
      {
          return $this->ID;
      }

      /**
       * Set the value of ID
       *
       * @param mixed debug
       *
       * @return self
       */
      public function setID($ID)
      {
          $this->ID = $ID;

          return $this;
      }



    /**
     * Get the value of Light Cloud © 2017
     *
     * @return mixed
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Set the value of Light Cloud © 2017
     *
     * @param mixed debug
     *
     * @return self
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * Get the value of Pdo
     *
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Set the value of Pdo
     *
     * @param mixed pdo
     *
     * @return self
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    /**
     * Get the value of Table
     *
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of Table
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

}
