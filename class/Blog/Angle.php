<?php

require_once("Crud.php");

class Angle extends Crud{

    const VALUES = array("LibAngl","NumLang"); 
    const TABLE = "ANGLE";
    const PRIMARY = "NumAngl";

    public function __construct($primaryKeyValue)
    {
        parent::__construct($primaryKeyValue);
    }

    protected static function getNextID($postVar, $conn) : string
    {  
        $NumLang = ctrlSaisies($postVar["NumLang"]);
        
        $LibLangSelect = substr($NumLang, 0, 4); 
        $parmNumLang = $LibLangSelect . '%';
  
        $requete = "SELECT MAX(NumLang) AS NumLang FROM ANGLE WHERE NumLang LIKE '$parmNumLang';";
        $result = $conn->query($requete);
  
        if ($result) {
            $tuple = $result->fetch();
        
            $numSeq2Angl = 0; //Fix temporaire
            $NumLang = $tuple["NumLang"];
            if (is_null($NumLang)) {    // New lang dans ANGLE
                $numSeq2Angl = 0;  
            }
            // No séquence suivant LANGUE
            $numSeq2Angl++;
            // No séquence ANGLE
            $numSeq1Angl = 0;
  
            // No séquence ANGLE : Récup dernière PK utilisée
            $requete = "SELECT MAX(NumAngl) AS NumAngl FROM ANGLE;";
  
            $result = $conn->query($requete);
            $tuple = $result->fetch();
            $NumAngl = $tuple["NumAngl"];
  
            $NumAnglSelect = (int)substr($NumAngl, 4, 2);
            $numSeq1Angl = $NumAnglSelect + 1;
  
            $LibAnglSelect = "ANGL";
            // PK reconstituée : ANGL + no seq angle
            if ($numSeq1Angl < 10) {
                $NumAngl = $LibAnglSelect . "0" . $numSeq1Angl;
            }
            else {
                $NumAngl = $LibAnglSelect . $numSeq1Angl;
            }
            // PK reconstituée : ANGL + no seq angle + no seq langue
            if ($numSeq2Angl < 10) {
                $NumAngl = $NumAngl . "0" . $numSeq2Angl;
            }
            else {
                $NumAngl = $NumAngl . $numSeq2Angl;
            }
        }   // End of if ($result) / no seq angle
        return $NumAngl;
      }
}

?>