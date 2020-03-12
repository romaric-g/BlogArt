<?php

require "./../Connection.php";


var_dump($conn);    

class Article {

    private $NumArt;

    private $DtCreA;
    private $LibTitrA;
    private $LibChapoA;
    private $LibAccrochA;
    private $Parag1A;
    private $LibSsTitr1;
    private $Parag2A;
    private $LibSsTitr2;
    private $Parag3A;
    private $LibConclA;
    private $UrlPhotA;
    private $Likes;

    private $NumAngl;
    private $NumThem;

    private $comments = array();

    public function __construct(string $NumArt)
    {
        $this->NumArt = $NumArt;
    }

    public function load($conn)
    {
        $request = "SELECT * FROM `ARTICLE` WHERE `NumArt` = '$this->NumArt'";
        $response = $conn->query($request);
        if($response) {
            $row = $response->fetch();
        }
        
    }
}

$article = new Article("09");
$article->load($conn);

?>