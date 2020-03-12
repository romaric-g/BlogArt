<?php 

function createLangue($NumLang, $Lib1Lang, $Lib2Lang, $numPays, $conn){  
    try {
        $stmt = $conn->prepare("INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays) VALUES (:NumLang, :Lib1Lang, :Lib2Lang, :NumPays)");
        $stmt->bindParam(':NumLang', $NumLang);
        $stmt->bindParam(':Lib1Lang', $Lib1Lang);
        $stmt->bindParam(':Lib2Lang', $Lib2Lang);
        $stmt->bindParam(':NumPays', $numPays);
        $stmt->execute();
        
        return TRUE;
    } catch (\Throwable $th) {
        return NULL;
    }
}

?>