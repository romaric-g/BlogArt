<?php

require_once("./../Utils/connection.php");

class User {

    public const LOGGED = "LOGGED";

    private $pseudo;
    private $admin;
    private $pass;

    public $lastname;
    public $firstname;
    public $email;
    

    public function __construct($pseudo)
    {
        $this->setPseudo($pseudo);
    }

    public function isLogged($session) : bool{
        return isset($session) && $session[self::LOGGED] === $this->pseudo;
    }

    public function exist($conn) : bool {
        return $this->find($conn) != NULL;
    }
    
    public function update($conn) {
        $DBPseudoFormat = $this->getDBPseudoFormat();
        $request = "UPDATE USER SET Pass='$this->pass',LastName='$this->lastname',FirstName='$this->firstname',EMail='$this->email' WHERE login = '$DBPseudoFormat'";
        try {
            $prepare = $conn->prepare($request);
            $prepare->execute();
        } catch (\PDOException $th) {
            var_dump($th);
            $this->error = $th;
        }
    }

    public function load($conn) {
        $row = $this->find($conn);
        if($row != NULL) {
            $pseudo = $row["Login"];
            $this->setPseudo($pseudo);
            $this->setAdmin( ($pseudo[0] == "*") );
            $this->pass = $row["Pass"];
            $this->lastname = $row["LastName"];
            $this->firstname = $row["FirstName"];
            $this->email = $row["EMail"];
        }
    }

    public function create($conn) {
        $request = "INSERT INTO `user`(`Login`, `Pass`, `LastName`, `FirstName`, `EMail`) VALUES (:Login, :Pass, :LastName, :FirstName, :EMail)";

        $prepare = $conn->prepare($request);
        $prepare->bindParam(":Login", $this->pseudo);
        $prepare->bindParam(":Pass", $this->pass);
        $prepare->bindParam(":LastName", $this->lastname);
        $prepare->bindParam(":FirstName", $this->firstname);
        $prepare->bindParam(":EMail", $this->email);
        try {
            $prepare->execute();
        } catch (\PDOException $th) {
            $this->error = $th;
        }
    }



    public function setPseudo($pseudo) {
        $this->pseudo = self::realPseudo($pseudo);
    }
    public function getPseudo() : string {
        return $this->pseudo;
    }
    public static function realPseudo($pseudo) : string {
        return ltrim($pseudo, '*');
    }
    public function setAdmin($bool) {
        $this->admin = $bool;
    }
    public function isAdmin() : bool {
        return $this->admin;
    }
    private function getDBPseudoFormat() {
        return ($this->admin) ? "*" : "" . $this->pseudo;
    }
    private function find($conn) {
        $likeSearch = '%' . $this->pseudo;
        $request = "SELECT * FROM USER WHERE LOGIN LIKE '$likeSearch'";
        $result = $conn->query($request);
        while($row = $result->fetch()){
            $rowPseudo = self::realPseudo($row["Login"]);
            if($rowPseudo === $this->pseudo) {
                return $row;
            }
        }
        return NULL;
    }
}

?>