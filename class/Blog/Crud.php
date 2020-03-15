<?php

require_once( __DIR__ . "/../Utils/ctrlSaisies.php");
require_once("Join.php");

abstract class Crud {

    const VALUES = array(); 
    const TABLE = "";
    const PRIMARY = "";


    public $tableName;
    public $primaryKeyName;
    public $valuesName = array();

    public $primaryKeyValue;
    public $values = array();

    public $tuple;

    public $success = NULL;
    public $error = NULL;

    public function __construct($primaryKeyValue)
    {
        $this->tableName = static::TABLE;
        $this->primaryKeyName = static::PRIMARY;
        $this->valuesName = static::VALUES;
        $this->primaryKeyValue = $primaryKeyValue;
    }

    public function create($connection) : bool{
        $valuesJoined = $this->primaryKeyName . ", ";
        $valuesJoined .= join(", ", $this->valuesName);
        $valuesBindJoined = ":" . $this->primaryKeyName . ", ";
        $valuesBindJoined .= rtrim((":" . join(", :", $this->valuesName)), ":");
        $request = "INSERT INTO $this->tableName ($valuesJoined) VALUES ($valuesBindJoined)";

        var_dump($request);

        $prepare = $connection->prepare($request);
        $prepare->bindParam((":".$this->primaryKeyName), $this->primaryKeyValue);
        foreach($this->values as $key => $value) {
            var_dump($key, $this->values[$key]);
            $prepare->bindParam(":". $key, $this->values[$key]);
        }

        try {
            $prepare->execute();
            $this->success = "L'element a bien été crée";
            return true;
        } catch (\PDOException $th) {
            $this->error = $th;
            return false;
        }        
    }

    public function loadDataFromSQL($connection, $joins = array())
    {
        $requete = "SELECT * FROM $this->tableName ";
        foreach($joins as $join){
            $requete .= $join->getJoinLine($this->tableName) . " ";
        }
        $requete .= "WHERE $this->primaryKeyName = '{$this->primaryKeyValue}'";
        $result = $connection->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $this->extractSQLDataRow($tuple);
        }
    }

    
    public static function loadAll($connection, $joins = array(), $whereAddition = "", $orderby = "")
    {
        $requete = "SELECT * FROM ". static::TABLE ." ";
        foreach($joins as $join){
            $requete .= $join->getJoinLine(static::TABLE) . " ";
        }
        if($whereAddition != ""){
            $requete .= "AND " . $whereAddition . " ";
        }
        if($orderby != ""){
            $requete .= $orderby;
        }
        $result = $connection->query($requete);

        $langues = array();

        while($langueRow = $result->fetch()) {
            $langue = new static($langueRow[static::PRIMARY]);

            $langue->extractSQLDataRow($langueRow);
            array_push($langues, $langue);
        }
        return $langues;
    }

    public function updateDataToSQL($connection)
    {
        $values = "";

        foreach($this->valuesName as $value) {
            $values .= $value . "='" . $this->values[$value] . "',";
        }
        $values = rtrim($values, ",");
        $request = "UPDATE $this->tableName SET $values WHERE $this->primaryKeyName = '{$this->primaryKeyValue}'";
        try {
            $stmt = $connection->prepare($request);
            $stmt->execute();
            $this->success = "La valeur a bien été modifée";
        } catch (\Throwable $th) {
            $this->error = $th->getMessage();
        }
    }

    public function changeData($postVar, $setEmptyToNull = true)
    {
        foreach($this->valuesName as $value) {
            if(isset($postVar[$value]) && !empty($postVar[$value]) ){
                $this->values[$value] = ctrlSaisies($postVar[$value]);
            }else if($setEmptyToNull) {
                $this->values[$value] = NULL;
            }
        }
    }

    public static function new($postVar, $conn) : self
    {   
        $NumLang = static::getNextID($postVar, $conn);
        $langue = NULL;

        $values = array();
        foreach(static::VALUES as $value) {
            if(isset($postVar[$value])){
                $values[$value] = ctrlSaisies($postVar[$value]);
            }else{
                $values[$value] = NULL;
            }
        }

        if($NumLang != NULL) {
            $langue = new static($NumLang);
            $langue->values = $values;
            $langue->create($conn);
        }
        return $langue;
    }

    protected abstract static function getNextID($postVar, $conn);

    protected function extractSQLDataRow($tuple)
    {
        foreach($this->valuesName as $key => $valueName) {
            $this->values[$valueName] = $tuple[$valueName];
        }
        $this->tuple = $tuple;
    }

    public static function paramsAllSet($postParams, $ignored = array()) 
    {
        $present = TRUE;
        foreach(static::VALUES as $params) {
            if( !in_array($params, $ignored) && (!isset($postParams[$params]) || $postParams[$params] === "") ){
                $present = FALSE;
                break;
            }
        }
        return $present;
    }
}
?>