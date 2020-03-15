<?php 
require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Angle.php");

$angle = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        if( Angle::paramsAllSet($_POST) ) {
            $angle = Angle::new($_POST, $conn);
        }
    }
}

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);

$HEADER = array("active" => "ANGLE");
include "./../common/header.php";
?>
    <div class="container">
        <h1>Ajoutez un angle</h1>
        <?php if($angle && ($angle->error || $angle->success)) { ?>
            <div class="alert alert-<?php echo ($angle->error ? "danger" : "success")?>" role="alert">
                <?php echo $angle->error ? $angle->error : $angle->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="LibAngl">Nom de l'angle</label>
                <input type="text" class="form-control" id="LibAngl" name="LibAngl" placeholder="Nom de la thématique" autofocus="autofocus">
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