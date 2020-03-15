<?php

require_once( __DIR__ . "/../link.php" );

if(!isset($HEADER)){
    $HEADER = array();
    $HEADER["active"] = NULL;
}

function active($link) {
    global $HEADER;
    return $HEADER["active"] == $link ? "active" : "";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= getLink("/styles/css/header.css") ?>">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2">
                <div class="content">
                    <div class="nav nav-pills nav-fill flex-column">
                        <a class="nav-item nav-link <?= active("ARTICLE") ?>" href="<?= getLink("/article") ?>">Articles</a>
                        <a class="nav-item nav-link <?= active("COMMENT") ?>" href="<?= getLink("/comment") ?>">Commentaires</a>
                        <a class="nav-item nav-link <?= active("LANGUE") ?>" href="<?= getLink("/langue") ?>">Langues</a>
                        <a class="nav-item nav-link <?= active("THEME") ?>" href="<?= getLink("/theme") ?>">Thématiques</a>
                        <a class="nav-item nav-link <?= active("KEYWORD") ?>" href="<?= getLink("/keyword") ?>">Mots clés</a>
                        <a class="nav-item nav-link <?= active("ANGLE") ?>" href="<?= getLink("/angle") ?>">Angles</a>
                    </div>
                </div>
            </nav>
            <div class="col">