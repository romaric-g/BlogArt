<?php 

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
    <div class="createlangue">
        <h1>Ajoutez une langue</h1>
        <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
        <?php } ?>
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