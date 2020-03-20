<?php 

require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Langue.php");

$langue = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        if( Langue::paramsAllSet($_POST) ) {
            $langue = Langue::new($_POST, $conn);
        }
    }
}

$requete = "SELECT * FROM `pays` WHERE 1";
$countries = $conn->query($requete);

$HEADER = array("active" => "LANGUE");
include "../common/header.php";
?>
    <div class="container">
        <h1>Ajoutez une langue</h1>
        <?php if($langue && ($langue->error || $langue->success)) { ?>
            <div class="alert alert-<?php echo ($langue->error ? "danger" : "success")?>" role="alert">
                <?php echo $langue->error ? $langue->error : $langue->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="Lib1Lang">Libellé court</label>
                <input type="text" class="form-control" id="Lib1Lang" name="Lib1Lang" maxlength="25" placeholder="Libellé court" autofocus="autofocus" >
            </div>
            <div class="form-group">
                <label for="Lib2Lang">Libellé long</label>
                <input type="text" class="form-control" id="Lib2Lang" name="Lib2Lang" maxlength="25" placeholder="Libellé long">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="NumPays">Pays</label>
                </div>
                <select class="custom-select" name="NumPays" id="NumPays">
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
<?php include "../common/footer.php"; ?>