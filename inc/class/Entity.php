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
  protected $fields = [];

  public function __construct()
  {
    $this->openDatabase();
    $this->setFields();
  }

  abstract function setFields();

  protected function closeDatabase()
  {
    $this->setPdo(null);
  }

  protected function openDatabase()
  {
    $this->setPdo(Database::instance());
  }

  /** SQL **/

  protected function create()
  {
    $query = file_get_contents(__DIR__ . '/../../storage/tables/' . $this->table . '.sql');
    $query = $this->getPdo()->prepare($query);

    if($this->debug == true) echo '[DEBUG] : REQUEST => ' . $query;
    if(!$query->execute() && $this->debug == true) die('[DEBUG] : ERROR WHILE CREATING ' . $this->table . ' TABLE ON ' . get_class($this) . ' !');
  }

  protected function drop()
  {
    $query = 'DROP TABLE `' . $this->table . '`;';
    $query = $this->getPdo()->prepare($query);

    if($this->debug == true) echo '[DEBUG] : REQUEST => ' . $query;
    if(!$query->execute() && $this->debug == true) die('[DEBUG] : ERROR WHILE DROPING ' . $this->table . ' TABLE ON ' . get_class($this) . ' !');
  }

  protected function load($columns)
  {
    $objects = [];
    $where = ' WHERE ';

    if($columns!=null && sizeof($columns)!=0){
      $i=false;
      foreach($columns as $column=>$value){
					if($i){$where .=' AND ';}else{$i=true;}
					$where .= '`'.$column.'`="'.$value.'"';
				}
    }

    $query = 'SELECT * FROM ' . $this->table . ' ' . $where . ';';
    $query = $this->getPdo()->prepare($query);

    if($query->execute() && $this->debug == true) die('[DEBUG] : ERROR WHILE FETCHING OBJECTS ON ' . get_class($this));
    while($queryReturn = $execQuery->fetchArray()){
			$object = new $this();
			foreach($this->fields as $field => $type)
				if(isset($queryReturn[$field])) $object->$field= html_entity_decode( addslashes($queryReturn[$field]));

			$objects[] = $object;
			unset($object);
		}

    return $objects;
  }

  protected function findOrFail($id)
  {
    return $this->load(['ID' => $id]);
  }

  protected function count($columns)
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

  protected function customQuery($sql)
  {
    $query = $this->getPdo()->prepare($sql);

    return $query->execute();
  }

  protected function checkTable()
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

    /**
     * Get the value of Fields
     *
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

}
