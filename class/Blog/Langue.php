<?php

class Langue {

    public $NumLang;
    public $Lib1Lang;
    public $Lib2Lang;
    public $NumPays;

    public $tuple;
    private $prepare;

    public function __construct(string $NumLang)
    {
        $this->NumLang = $NumLang;   
    }

    public function loadDataFromSQL($connection)
    {
        $requete = "SELECT * FROM LANGUE INNER JOIN PAYS ON LANGUE.NumPays = PAYS.numPays WHERE NumLang = '{$this->NumLang}'";
        $result = $connection->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $this->tuple = $tuple;
            $this->extractSQLDataRow($tuple);
        }
    }

    public function prepareUpdateSQL($connection)
    {
        $prepare = $connection->prepare("INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays) VALUES (:NumLang, :Lib1Lang, :Lib2Lang, :NumPays)");
        $prepare->bindParam(':NumLang', $this->NumLang);
        $prepare->bindParam(':Lib1Lang', $this->Lib1Lang);
        $prepare->bindParam(':Lib2Lang', $this->Lib2Lang);
        $prepare->bindParam(':NumPays', $this->numPays);
    }

    public function updateDataToSQL() {
        try {
            $this->prepare->execute();
        } catch (\PDOException $th) {
            throw $th;
        }        
    }

    public static function loadAll($connection)
    {
        $requete = "SELECT * FROM LANGUE INNER JOIN PAYS ON LANGUE.NumPays = PAYS.numPays";
        $result = $connection->query($requete);

        $langues = array();

        while($langueRow = $result->fetch()) {
            $langue = new Langue($langueRow["NumLang"]);
            $langue->extractSQLDataRow($langueRow);
            array_push($langues, $langue);
        }
        return $langues;
    }

    private function extractSQLDataRow($row)
    {
        $this->Lib1Lang = $row["Lib1Lang"];
        $this->Lib2Lang = $row["Lib2Lang"];
        $this->NumPays = $row["NumPays"];
    }
}

?>