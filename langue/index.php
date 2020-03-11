<?php 
$countries = getLangueList($conn);
?>
<div class="createlangue">
    <h1>Liste des langues</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Langue</th>
                <th scope="col">Nom complet</th>
                <th scope="col">Pays</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($country = $countries->fetch()){ ?>
                <tr>
                    <td><?php echo $country["Lib1Lang"] ?></td>
                    <td><?php echo $country["Lib2Lang"] ?></td>
                    <td><?php echo $country["NumPays"] ?></td>
                    <td><a href="./blog/delete_language.php?id=<?php echo $country["NumLang"] ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>      
</div>