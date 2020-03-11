<?php 
include "verifText.php";
include "connection.php";

$Lib1Lang = "";
$Lib2Lang = "";
$numPays = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';
    
    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        if( ( isset($_POST['Lib1Langs'])) AND 
            ( isset($_POST['Lib2Langs'])) AND
            ( isset($_POST['TypPays']))
        ) {
            $Lib1Lang = ctrlSaisies($_POST["Lib1Langs"]);
            $Lib2Lang = ctrlSaisies($_POST["Lib2Langs"]);
            $numPays = ctrlSaisies($_POST["TypPays"]);

            $error = false;

            $numPaysSelect = $numPays;
            $parmNumLang = $numPaysSelect . '%';
            $requete = "SELECT MAX(NumLang) AS NumLang FROM LANGUE WHERE NumLang LIKE '$parmNumLang';";

            $result = $conn->query($requete);
            
            if($result) {
                $tuple = $result->fetch();
                $NumLang = $tuple["NumLang"];
                $numSeqLang = 0;
                $StrLang = "";
                if(is_null($NumLang)) {
                    $NumLang = 0;
                    $StrLang = $numPaysSelect;
                }else{
                    $StrLang = substr($NumLang, 0, 4);
                    $numSeqLang = (int)substr($NumLang, 4);
                }
                $numSeqLang++;
                $NumLang = $StrLang . ($numSeqLang < 10 ? '0' : '') . $numSeqLang;

                try {
                    $stmt = $conn->prepare("INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays) VALUES (:NumLang, :Lib1Lang, :Lib2Lang, :NumPays)");
                    $stmt->bindParam(':NumLang', $NumLang);
                    $stmt->bindParam(':Lib1Lang', $Lib1Lang);
                    $stmt->bindParam(':Lib2Lang', $Lib2Lang);
                    $stmt->bindParam(':NumPays', $numPays);

                    $stmt->execute();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}

$requete = "SELECT * FROM `pays` WHERE 1";
$countries = $conn->query($requete);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogArt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Ajoutez une langue</h1>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="Lib1Lang">Libellé court</label>
                <input type="text" class="form-control" id="Lib1Langs" name="Lib1Langs" maxlength="25" placeholder="Libellé court" autofocus="autofocus" 
                value="<?php 
                        if(isset($_GET["id"])) {
                            echo $_POSt["LibLang1"];
                        }
                        ?>">
            </div>
            <div class="form-group">
                <label for="Lib2Lang">Libellé long</label>
                <input type="text" class="form-control" id="Lib2Langs" name="Lib2Langs" maxlength="25" placeholder="Libellé long">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="TypPays">Pays</label>
                </div>
                <select class="custom-select" name="TypPays" id="TypPays">
                    <?php 
                    while($country = $countries->fetch()){ 
                        echo '<option value="' . $country["numPays"] . '"' . 
                        ' ' . ($country["numPays"] == "FRAN" ? 'selected' : '') . 
                        ' >' . $country['frPays']. '</option>';
                    }
                    ?>
                </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</body>
</html>