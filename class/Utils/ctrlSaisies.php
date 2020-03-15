<?php
    ////////////////////////////////////////////////////////////////////////////
    //
    //  Méthodes fournies
    //  Script : controlerSaisies.php
    //
    ////////////////////////////////////////////////////////////////////////////
    //
    ////////////////////////////////////////////////////////////////////////////
    // CTRL du contenu des saisies à partir des fonctions PHP 
    ////////////////////////////////////////////////////////////////////////////

    // Fonction de controle des saisies du formulaire
    function ctrlSaisies($saisie) {

      // Suppression des espaces (ou d'autres caractères) en début et fin de chaîne
      $saisie = trim($saisie);
      // Suppression des antislashs d'une chaîne
      $saisie = stripslashes($saisie);
      // Conversion des caractères spéciaux en entités HTML 
      $saisie = htmlentities($saisie);

      return $saisie;
    }

?>
