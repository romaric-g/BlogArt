<?php 
require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/KeyWord.php");

$keyword = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        if( KeyWord::paramsAllSet($_POST) ) {
            $keyword = KeyWord::new($_POST, $conn);
        }
    }
}

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);

$HEADER = array("active" => "KEYWORD");
include "./../common/header.php";
?>
    <div class="container">
        <h1>Ajoutez un mot clé</h1>
        <?php if($keyword && ($keyword->error || $keyword->success)) { ?>
            <div class="alert alert-<?php echo ($keyword->error ? "danger" : "success")?>" role="alert">
                <?php echo $keyword->error ? $keyword->error : $keyword->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="LibMoCle">Mot clé</label>
                <input type="text" class="form-control" id="LibMoCle" name="LibMoCle" maxlength="25" placeholder="Mot clé" autofocus="autofocus" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="NumLang">Langue</label>
                </div>
                <select class="custom-select" name="NumLang" id="NumLang">
                    <?php while($langue = $langues->fetch()){ ?>
                        <option value="<?=$langue["NumLang"]?>"  <?= ($langue["NumPays"] == "FRAN" ? 'selected' : '')?>><?= $langue['Lib1Lang'] ?></option>
                    <?php }?>
                </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php include "./../common/footer.php";?>