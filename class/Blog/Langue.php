<?php

class Langue {

    public $NumLang;
    public $Lib1Lang;
    public $Lib2Lang;
    public $NumPays;

    public $tuple;

    public $success;
    public $error;

    public function __construct(string $NumLang)
    {
        $this->NumLang = $NumLang;   
    }

    public function create($connection) : bool{
        $prepare = $connection->prepare("INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays) VALUES (:NumLang, :Lib1Lang, :Lib2Lang, :NumPays)");
        $prepare->bindParam(':NumLang', $this->NumLang);
        $prepare->bindParam(':Lib1Lang', $this->Lib1Lang);
        $prepare->bindParam(':Lib2Lang', $this->Lib2Lang);
        $prepare->bindParam(':NumPays', $this->numPays);

        try {
            $prepare->execute();
            $this->success = "La langue {$this->Lib1Lang} a bien été crée";
            return true;
        } catch (\PDOException $th) {
            $this->error = $th;
            return false;
        }        
    }

    public function loadDataFromSQL($connection)
    {
        $requete = "SELECT * FROM LANGUE INNER JOIN PAYS ON LANGUE.NumPays = PAYS.numPays WHERE NumLang = '{$this->NumLang}'";
        $result = $connection->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $this->extractSQLDataRow($tuple);
        }
    }

    public function updateDataToSQL($connection)
    {
        try {
            $stmt = $connection->prepare("UPDATE langue SET Lib1Lang=':NumLang',Lib2Lang=':Lib1Lang',NumPays=':Lib2Lang' WHERE NumLang = ':NumPays'");
            $stmt->bindParam(':NumLang', $this->NumLang);
            $stmt->bindParam(':Lib1Lang', $this->Lib1Lang);
            $stmt->bindParam(':Lib2Lang', $this->Lib2Lang);
            $stmt->bindParam(':NumPays', $this->numPays);
            $stmt->execute();
            $this->success = "La valeur de $this->Lib1Lang a bien été modifée";
        } catch (\Throwable $th) {
            error();
        }
    }

    private function extractSQLDataRow($tuple)
    {
        $this->Lib1Lang = $tuple["Lib1Lang"];
        $this->Lib2Lang = $tuple["Lib2Lang"];
        $this->NumPays = $tuple["NumPays"];
        $this->tuple = $tuple;
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

    public static function new($Lib1Lang, $Lib2Lang, $numPays, $conn) : self
    {   
        $NumLang = self::getNextLangueID($numPays, $conn);
        $langue = NULL;

        if($NumLang != NULL) {
            $langue = new Langue($NumLang);
            $langue->Lib1Lang = $Lib1Lang;
            $langue->Lib2Lang = $Lib2Lang;
            $langue->numPays = $numPays;
            $langue->create($conn);
        }else{
            $NumLang->error = "Impossible de créer la langue";
        }
        return $langue;
    }

    public static function getNextLangueID($numPays, $conn) : string
    {  
        $numPaysSelect = $numPays;
        $parmNumLang = $numPaysSelect . '%';
        $requete = "SELECT MAX(NumLang) AS NumLang FROM LANGUE WHERE NumLang LIKE '$parmNumLang';";

        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumLang = $tuple["NumLang"];
            $numSeqLang = 0;
            $StrLang = $numPaysSelect;
            if(!is_null($NumLang)) {
                $StrLang = substr($NumLang, 0, 4);
                $numSeqLang = (int)substr($NumLang, 4);
            }
            $numSeqLang++;
            return $StrLang . ($numSeqLang < 10 ? '0' : '') . $numSeqLang;
        }
    }
}

?>