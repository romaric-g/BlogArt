<?php

require_once("Crud.php");
require_once("KeyWord.php");

class Article extends Crud{

    const VALUES = array("DtCreA","LibTitrA","LibChapoA","LibAccrochA","Parag1A","LibSsTitr1","Parag2A","LibSsTitr2","Parag3A","LibConclA","UrlPhotA",
                         "Likes","NumAngl","NumThem","NumLang"); 
    const TABLE = "ARTICLE";
    const PRIMARY = "NumArt";

    public $keywordsNum = array();
    public $keywords = array();

    public function __construct($primaryKeyValue) 
    {
        parent::__construct($primaryKeyValue);
    }

    protected static function getNextID($postVar, $conn) : string
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

    public function loadKeywords($conn) 
    {
        $request = "SELECT * FROM `motclearticle` WHERE NumArt = '$this->primaryKeyValue'";
        $result = $conn->query($request);
        $this->keywordsNum = array();
        $this->keywords = array();
        while($tuple = $result->fetch()) {
            $NumMoCle = $tuple["NumMoCle"];
            array_push($this->keywordsNum, $NumMoCle);
            $keyword = new KeyWord($NumMoCle);
            $keyword->loadDataFromSQL($conn);
            array_push($this->keywords, $keyword);
        }
    }

    public function setKeywordsFromString($keywordsString) 
    {
        $this->keywordsNum = explode(",",$keywordsString);
        var_dump($this->keywordsNum);
    }


    public function updateKeywords($conn) 
    {
        $numArt = $this->primaryKeyValue;
        $request = "SELECT * FROM `motclearticle` WHERE NumArt = '$numArt'";
        $result = $conn->query($request);

        $addKey = $this->keywordsNum;
        $removeKey = array();

        while($tuple = $result->fetch()) {
            $key = $tuple["NumMotCle"];
            if(in_array($key, $this->keywordsNum)) {
                array_diff($addKey, [$key]);
            }else{
                array_push($removeKey, $key);
            }
        }
        echo "ADD TO DB: ";
        var_dump($addKey);
        echo "REMOVE FROM DB: ";
        var_dump($removeKey);

        foreach($addKey as $key) {
            $request = "INSERT INTO `motclearticle`(`NumArt`, `NumMoCle`) VALUES (:NumArt, :NumMoCle)";
            $prepare = $conn->prepare($request);
            $prepare->bindParam(":NumArt", $numArt);
            $prepare->bindParam(":NumMoCle", $key);
            $prepare->execute();
        }
        foreach($removeKey as $key) {
            $request = "DELETE FROM `motclearticle` WHERE NumArt = '$numArt' AND NumMoCle = '$key'";
            $prepare = $conn->exec($request);
        }
    }
}

?>