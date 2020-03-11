<?php 
include "verifText.php";
include "connection.php";
include "blog/get_langue.php";
include "blog/insert_langue.php";

$Lib1Lang = "";
$Lib2Lang = "";
$numPays = "";

$error = NULL;
$success = NULL;

function error() {
    $error = "Une erreur c'est produite!";
}

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

            $NumLang = getNextLangueID($numPays, $conn);

            if($NumLang != NULL) {
                if(createLangue($NumLang, $Lib1Lang, $Lib2Lang, $numPays, $conn)) {
                    $success = "La langue " . $Lib1Lang . " a bien été crée";
                }else{
                    error();
                }
            }else{
                error();
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Ajoutez une langue</h1>
        <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="Lib1Lang">Libellé court</label>
                <input type="text" class="form-control" id="Lib1Langs" name="Lib1Langs" maxlength="25" placeholder="Libellé court" autofocus="autofocus" >
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
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
</body>
</html>