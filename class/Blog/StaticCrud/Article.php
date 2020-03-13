<?php
class Article {

    public $NumArt;

    public $DtCreA;
    public $LibTitrA;
    public $LibChapoA;
    public $LibAccrochA;
    public $Parag1A;
    public $LibSsTitr1;
    public $Parag2A;
    public $LibSsTitr2;
    public $Parag3A;
    public $LibConclA;
    public $UrlPhotA;
    public $Likes;

    public $NumAngl;
    public $NumThem;
    public $NumLang;

    private $comments = array();

    public function __construct(string $NumArt)
    {
        $this->NumArt = $NumArt;
    }

    public function load($conn)
    {
        $request = "SELECT * FROM ARTICLE WHERE `NumArt` = '$this->NumArt'";
        $result = $conn->query($request);

        if($result) {
            $tuple = $result->fetch();
            $this->extractSQLDataRow($tuple);
        }
        
    }

    public function create($connection) : bool{
        $prepare = $connection->prepare(
            "INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A, LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes, NumAngl, NumThem, NumLang) 
            VALUES (:NumArt, :DtCreA, :LibTitrA, :LibChapoA, :LibAccrochA, :Parag1A, :LibSsTitr1, :Parag2A, :LibSsTitr2, :Parag3A, :LibConclA, :UrlPhotA, :Likes, :NumAngl, :NumThem, :NumLang)"
        );
        $prepare->bindParam(':NumArt', $this->NumLang);
        $prepare->bindParam(':DtCreA', $this->DtCreA);
        $prepare->bindParam(':LibTitrA', $this->LibTitrA);
        $prepare->bindParam(':LibChapoA', $this->LibChapoA);
        $prepare->bindParam(':LibAccrochA', $this->LibAccrochA);
        $prepare->bindParam(':Parag1A', $this->Parag1A);
        $prepare->bindParam(':LibSsTitr1', $this->LibSsTitr1);
        $prepare->bindParam(':Parag2A', $this->Parag2A);
        $prepare->bindParam(':LibSsTitr2', $this->LibSsTitr2);
        $prepare->bindParam(':Parag3A', $this->Parag3A);
        $prepare->bindParam(':LibConclA', $this->LibConclA);
        $prepare->bindParam(':UrlPhotA', $this->UrlPhotA);
        $prepare->bindParam(':Likes', $this->Likes);
        $prepare->bindParam(':NumAngl', $this->NumAngl);
        $prepare->bindParam(':NumThem', $this->NumThem);
        $prepare->bindParam(':NumLang', $this->NumLang);

        try {
            $prepare->execute();
            $this->success = "L'Article {$this->LibTitrA} a bien été crée";
            return true;
        } catch (\PDOException $th) {
            $this->error = $th;
            return false;
        }        
    }

    public function loadDataFromSQL($connection)
    {
        $requete = "SELECT * FROM ARTICLE WHERE NumLang = '{$this->NumLang}'";
        $result = $connection->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $this->extractSQLDataRow($tuple);
        }
    }

    public function updateDataToSQL($connection)
    {
        try {
            $stmt = $connection->prepare("UPDATE article SET DtCreA='$this->DtCreA',
                                                            LibTitrA='$this->LibTitrA'
                                                            LibChapoA='$this->LibChapoA',
                                                            LibAccrochA='$this->LibAccrochA',
                                                            Parag1A='$this->Parag1A',
                                                            LibSsTitr1='$this->LibSsTitr1',
                                                            Parag2A='$this->Parag2A',
                                                            LibSsTitr2='$this->LibSsTitr2',
                                                            Parag3A='$this->Parag3A',
                                                            LibConclA='$this->LibConclA',
                                                            UrlPhotA='$this->UrlPhotA',
                                                            Likes='$this->Likes',
                                                            NumAngl='$this->NumAngl',
                                                            NumThem='$this->NumThem',
                                                            NumLang='$this->NumLang',
                                                             WHERE NumArt = '$this->NumArt'");
            $stmt->execute();
            $this->success = "La valeur de $this->Lib1Lang a bien été modifée";
        } catch (\Throwable $th) {
            $this->error = "Erreur";
        }
    }

    private function extractSQLDataRow($tuple)
    {
        $this->DtCreA = $tuple["DtCreA"];
        $this->LibTitrA = $tuple["LibTitrA"];
        $this->LibChapoA = $tuple["LibChapoA"];
        $this->LibAccrochA = $tuple["LibAccrochA"];
        $this->Parag1A = $tuple["Parag1A"];
        $this->LibSsTitr1 = $tuple["LibSsTitr1"];
        $this->Parag2A = $tuple["Parag2A"];
        $this->LibSsTitr2 = $tuple["LibSsTitr2"];
        $this->Parag3A = $tuple["Parag3A"];
        $this->LibConclA = $tuple["LibConclA"];
        $this->UrlPhotA = $tuple["UrlPhotA"];
        $this->Likes = $tuple["Likes"];

        $this->NumAngl = $tuple["NumAngl"];
        $this->NumThem = $tuple["NumThem"];
        $this->NumLang = $tuple["NumLang"];
    }

    public static function loadAll($connection)
    {
        $requete = "SELECT * FROM ARTICLE";
        $result = $connection->query($requete);

        $articles = array();

        while($articleRow = $result->fetch()) {
            $article = new Article($articleRow["NumArt"]);

            $article->extractSQLDataRow($articleRow);
            array_push($articles, $article);
        }
        return $articles;
    }

    public static function new($DtCreA, $LibTitrA, $LibChapoA, $LibAccrochA, $Parag1A, $LibSsTitr1, $Parag2A, $LibSsTitr2, $Parag3A, $LibConclA, $UrlPhotA, $Likes, $NumAngl, $NumThem, $NumLang, $conn)
    {   
        $NumArt = self::getNextID($conn);
        $article = NULL;

        if($NumArt != NULL) {
            $article = new self($NumArt);
            $article->DtCreA = $DtCreA;
            $article->LibTitrA = $LibTitrA;
            $article->LibChapoA = $LibChapoA;
            $article->LibAccrochA = $LibAccrochA;
            $article->Parag1A = $Parag1A;
            $article->LibSsTitr1 = $LibSsTitr1;
            $article->Parag2A = $Parag2A;
            $article->LibSsTitr2 = $LibSsTitr2;
            $article->Parag3A = $Parag3A;
            $article->LibConclA = $LibConclA;
            $article->UrlPhotA = $UrlPhotA;
            $article->Likes = $Likes;

            $article->NumAngl = $NumAngl;
            $article->NumThem = $NumThem;
            $article->NumLang = $NumLang;
            $article->create($conn);
        }
        return $article;
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