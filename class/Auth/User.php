<?php

require_once("AuthException.php");

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

    public function connect($email, $pass) {
        if( $this->email == $email && $this->pass == $pass ) {
            if(isset($_SESSION)) {
                $_SESSION[self::LOGGED] = $this->pseudo;
            }else{
                throw new AuthException("Session désactivé");
            }
        }else{
            throw new AuthException("Email ou mot de passe incorrect");
        }
    }
    public static function loggout() {
        unset($_SESSION[self::LOGGED]);
    }
    public function isLogged() : bool{
        return isset($_SESSION) && isset($_SESSION[self::LOGGED]) === $this->pseudo;
    }
    public static function getLoggedUser($conn = NULL) {
        if(isset($_SESSION[self::LOGGED]) && !empty($_SESSION[self::LOGGED])) {
            $user = new User($_SESSION[self::LOGGED]);
            if($conn)$user->load($conn);
            return $user;
        }else{
            return NULL;
        }
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

    private function create($conn) {
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



    private function setPseudo($pseudo) {
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

    public static function getRandomID($prenom) {
        $date = date_create();
        $timestamp = substr((date_timestamp_get($date)),7);
        $rand = str_pad(rand( 0 , 999),3,0);
        return substr($prenom, 0, 10) . ($timestamp . $rand);
    }

    public static function emailIsUsed($email, $conn) : bool
    {
        $result = $conn->query("SELECT * FROM USER WHERE Email = '$email'");
        return $result->rowCount();
    }

    public static function new($email, $firstname, $lastname, $pass, $conn) {
        $user = NULL;
        if(!self::emailIsUsed($email, $conn)) {
            $find = false;
            $try = 10;
            while(!$find && $try) {
                $try--;
                $Login = self::getRandomID($firstname);
                $result = $conn->query("SELECT * FROM USER WHERE Login = '$Login'");
                $find  = !$result->rowCount();
                if($find) {
                    $user = new User($Login);
                    //$user->pass = password_hash($pass, PASSWORD_DEFAULT);
                    $user->pass = $pass;
                    $user->firstname = $firstname;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->create($conn);
                    break;
                }
            }

            
        }else{
            throw new Exception('Cette adresse email est déja utilisé');
        }
        return $user;
    }
}

?>