<?php

require_once("Crud.php");
require_once("../verifText.php");

class Article extends Crud{

    const VALUES = array("DtCreA","LibTitrA","LibChapoA","LibAccrochA","Parag1A","LibSsTitr1","Parag2A","LibSsTitr2","Parag3A","LibConclA","UrlPhotA",
                         "Likes","NumAngl","NumThem","NumLang"); 
    const TABLE = "ARTICLE";
    const PRIMARY = "NumArt";

    public function __construct($primaryKeyValue)
    {
        parent::__construct(self::TABLE, self::PRIMARY, self::VALUES, $primaryKeyValue);
    }

    public static function loadAll($connection)
    {
        $requete = "SELECT * FROM ". self::TABLE;
        $result = $connection->query($requete);
        $elements = array();
        while($row = $result->fetch()) {
            $element = new self($row[self::PRIMARY]);

            $element->extractSQLDataRow($row);
            array_push($elements, $element);
        }
        return $elements;
    }

    public static function new($postVar, $conn) : self
    {   
        $NumLang = self::getNextID($conn);
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
            $NumLang->error = "Impossible de créer l'Article";
        }
        return $langue;
    }

    public static function getNextID($conn)
    {  
        $requete = "SELECT MAX(NumArt) AS NumArt FROM ARTICLE";
        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumArt = $tuple["NumArt"];
            if(is_null($NumArt)) {
                $NumArt = 0;
            }
            $NumArt++;
            return  (($NumArt < 10 ? '0' : '') . $NumArt);
        }
    }
}

?>