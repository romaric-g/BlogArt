<?php 

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Article.php");

$langue = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        $_POST['DtCreA'] = date("Y-m-d");
        $_POST['Likes'] = 0;
        var_dump($_POST);
        if( Article::paramsAllSet($_POST) ) {
            $langue = Article::new($_POST, $conn);
        }
    }
}

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);

$requete = "SELECT * FROM `angle` WHERE 1";
$angles = $conn->query($requete);

$requete = "SELECT * FROM `thematique` WHERE 1";
$thematiques = $conn->query($requete);


$HEADER = array("active" => "ARTICLE");
include "./../common/header.php";
?>
    <div class="container">
        <h1>Créer un nouvelle article</h1>
        <?php if($langue && ($langue->error || $langue->success)) { ?>
            <div class="alert alert-<?php echo ($langue->error ? "danger" : "success")?>" role="alert">
                <?php echo $langue->error ? $langue->error : $langue->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
           <div class="form-group">
                <label for="LibTitrA">Titre de l'Article</label>
                <input type="text" class="form-control" id="LibTitrA" name="LibTitrA" maxlength="25" placeholder="Titre de l'Article" autofocus="autofocus" >
            </div> 
            <div class="form-group">
                <label for="LibChapoA">Chapeau de l'Article</label>
                <textarea class="form-control" id="LibChapoA" name="LibChapoA" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="LibAccrochA">Phrase d'accroche</label>
                <input type="text" class="form-control" id="LibAccrochA" name="LibAccrochA" maxlength="25" placeholder="Phrase d'accroche" autofocus="autofocus" >
            </div>
            <div class="form-group">
                <label for="Parag1A">Paragraphe 1</label>
                <textarea class="form-control" id="Parag1A" name="Parag1A" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="LibSsTitr1">LibSsTitr1</label>
                <textarea class="form-control" id="LibSsTitr1" name="LibSsTitr1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="Parag2A">Paragraphe 2</label>
                <textarea class="form-control" id="Parag2A" name="Parag2A" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="LibSsTitr2">LibSsTitr2</label>
                <textarea class="form-control" id="LibSsTitr2" name="LibSsTitr2" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="Parag3A">Paragraphe 3</label>
                <textarea class="form-control" id="Parag3A" name="Parag3A" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="LibConclA">LibConclA</label>
                <textarea class="form-control" id="LibConclA" name="LibConclA" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="UrlPhotA">Lien de la photo</label>
                <input type="text" class="form-control" id="UrlPhotA" name="UrlPhotA" maxlength="25" placeholder="Lien de la photo" autofocus="autofocus" >
            </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NumLang">Langue</label>
                    </div>
                    <select class="custom-select" name="NumLang" id="NumLang">
                        <?php while($langue = $langues->fetch()){ ?>
                            <option value="<?=$langue["NumLang"]?>" <?= ($langue["NumPays"] == "FRAN" ? 'selected' : '')?>><?= $langue['Lib1Lang'] ?></option>
                        <?php }?>
                    </select>
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NumThem">Théme</label>
                    </div>
                    <select class="custom-select" name="NumThem" id="NumThem">
                        <?php while($thematique = $thematiques->fetch()){ ?>
                            <option value="<?=$thematique["NumThem"]?>"><?= $thematique['LibThem'] ?></option>
                        <?php }?>
                    </select>
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NumAngl">Angle</label>
                    </div>
                    <select class="custom-select" name="NumAngl" id="NumAngl">
                        <?php while($angle = $angles->fetch()){ ?>
                            <option value="<?=$angle["NumAngl"]?>"><?= $angle['LibAngl'] ?></option>
                        <?php }?>
                    </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php include "./../common/footer.php"; ?>