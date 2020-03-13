<?php
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

    public function __construct(string $tableName, $primaryKeyName, $valuesName, $primaryKeyValue)
    {
        $this->tableName = $tableName;
        $this->primaryKeyName = $primaryKeyName;
        $this->valuesName = $valuesName;
        $this->primaryKeyValue = $primaryKeyValue;
    }

    public function create($connection) : bool{
        $valuesJoined = $this->primaryKeyName . ", ";
        $valuesJoined .= join(", ", $this->valuesName);
        $valuesBindJoined = ":" . $this->primaryKeyName . ", ";
        $valuesBindJoined .= rtrim((":" . join(", :", $this->valuesName)), ":");
        $request = "INSERT INTO $this->tableName ($valuesJoined) VALUES ($valuesBindJoined)";

        $prepare = $connection->prepare($request);
        $prepare->bindParam((":".$this->primaryKeyName), $this->primaryKeyValue);
        foreach($this->values as $key => $value) {
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

    public function loadDataFromSQL($connection)
    {
        $requete = "SELECT * FROM $this->tableName WHERE $this->primaryKeyName = '{$this->primaryKeyValue}'";
        $result = $connection->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $this->extractSQLDataRow($tuple);
        }
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

    public function changeData($postVar)
    {
        foreach($this->valuesName as $value) {
            if(isset($postVar[$value])){
                $this->values[$value] = ctrlSaisies($postVar[$value]);
            }else{
                $this->values[$value] = NULL;
            }
        }
    }

    protected function extractSQLDataRow($tuple)
    {
        foreach($this->valuesName as $key => $valueName) {
            $this->values[$valueName] = $tuple[$valueName];
        }
        $this->tuple = $tuple;
    }

    public static function paramsAllSet($postParams) 
    {
        $present = TRUE;
        foreach(static::VALUES as $params) {
            echo "$params";
            if(!isset($postParams[$params])){
                $present = FALSE;
                break;
                echo "NOT SET";
            }else{
                echo "SET";
            }
        }
        return $present;
    }
}
?>