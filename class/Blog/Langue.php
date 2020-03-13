<?php

require_once("Crud.php");
require_once("../verifText.php");

class Langue extends Crud{

    const VALUES = array("Lib1Lang","Lib2Lang","NumPays"); 
    const TABLE = "LANGUE";
    const PRIMARY = "NumLang";

    public function __construct($primaryKeyValue)
    {
        parent::__construct(self::TABLE, self::PRIMARY, self::VALUES, $primaryKeyValue);
    }

    public static function loadAll($connection)
    {
        $requete = "SELECT * FROM ". self::TABLE ." INNER JOIN PAYS ON LANGUE.NumPays = PAYS.numPays";
        $result = $connection->query($requete);

        $langues = array();

        while($langueRow = $result->fetch()) {
            $langue = new Langue($langueRow[self::PRIMARY]);

            $langue->extractSQLDataRow($langueRow);
            array_push($langues, $langue);
        }
        return $langues;
    }

    public static function new($postVar, $conn) : self
    {   
        $NumLang = self::getNextLangueID(ctrlSaisies($postVar["NumPays"]), $conn);
        $langue = NULL;

        $values = array();
        foreach(self::VALUES as $value) {
            if(isset($postVar[$value])){
                $values[$value] = ctrlSaisies($postVar[$value]);
            }else{
                $values[$value] = NULL;
            }
        }

        if($NumLang != NULL) {
            $langue = new self($NumLang);
            $langue->values = $values;
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