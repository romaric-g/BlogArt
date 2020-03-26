<?php 

require_once("Crud.php");

class Comment extends Crud {

    const VALUES = array("DtCreC","PseudoAuteur","EmailAuteur","TitrCom","LibCom","NumArt"); 
    const TABLE = "COMMENT";
    const PRIMARY = "NumCom";

    protected static function getNextID($postVar, $conn) : string
    {  
        $requete = "SELECT MAX(NumCom) AS NumCom FROM COMMENT";
        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumCom = $tuple["NumCom"];
            if(is_null($NumCom)) {
                $NumCom = 0;
            }
            $NumCom++;
            return  (($NumCom < 10 ? '00' : ($NumCom < 100 ? '0' : '') ) . $NumCom);
        }
    } 

    public static function loadRealComment($connection, $joins = array(), $whereAddition = "", $orderby = "") {
        if($whereAddition)$whereAddition .= " AND ";
        $whereAddition .= "TitrCom != 'LIKE'";
        return self::loadAll($connection, $joins, $whereAddition, $orderby);
    }

    public static function newRealComment($postVar, $user, $NumArt, $conn) {
        $postVar['DtCreC'] = date("Y-m-d H:i:s");
        $postVar['PseudoAuteur'] = $user->firstname;
        $postVar["EmailAuteur"] = $user->getPseudo();
        $postVar["TitrCom"] = "COMMENT";
        $postVar["NumArt"] = $NumArt;
        return self::new($postVar, $conn);
    }

    public static function hasFakeComToLike($Login, $NumArt, $conn) {
        $request = "SELECT * FROM `comment` WHERE EmailAuteur = '$Login' AND NumArt = '$NumArt' AND TitrCom = 'LIKE'";
        $result = $conn->query($request);
        return $result->rowCount();
    }

    public static function newFakeComToLike($Login, $NumArt, $conn) {
        $postVar['DtCreC'] = date("Y-m-d H:i:s");
        $postVar['PseudoAuteur'] = $Login;
        $postVar["EmailAuteur"] = $Login;
        $postVar["TitrCom"] = "LIKE";
        $postVar["LibCom"] = "LIKE";
        $postVar["NumArt"] = $NumArt;
        self::new($postVar, $conn);
        return self::changeLikeAmountOfArticle($NumArt, +1, $conn);
    }

    public static function removeFakeComToLike($Login, $NumArt, $conn) {
        $request = "DELETE FROM `comment` WHERE EmailAuteur = '$Login' AND NumArt = '$NumArt' AND TitrCom = 'LIKE'";
        $conn->exec($request);
        return self::changeLikeAmountOfArticle($NumArt, -1, $conn);
    }

    public static function getLikeAmountOfArticle($NumArt, $conn) {
        $request = "SELECT Likes FROM ARTICLE WHERE NumArt = $NumArt";
        $result = $conn->query($request);
        if($result->rowCount()) {
            return $result->fetch()["Likes"];
        }
        return 0;
    }

    public static function setLikeAmountOfArticle($NumArt, $likes, $conn) {
        $request = "UPDATE ARTICLE SET `Likes`=$likes WHERE NumArt = $NumArt";
        $stmt = $conn->prepare($request);
        $stmt->execute();
        return $likes;
    }
    
    public static function changeLikeAmountOfArticle($NumArt, $change, $conn) {
        $newValue = self::getLikeAmountOfArticle($NumArt, $conn) + $change;
        self::setLikeAmountOfArticle($NumArt, $newValue, $conn);
        return $newValue;
    }
}

?>