<?php

function NAV($langSelectedID, $user, $language, $rootPath, $conn) {

    require_once($rootPath . "class/Blog/Langue.php");
    require_once($rootPath . "class/Blog/Theme.php");
    
    $langSelected = NULL;
    
    $langs = Langue::loadAll($conn);
    $themes = Theme::loadAll($conn, array(), "NumLang = '$langSelectedID'");

    foreach($langs as $key => $lang) {
        if($lang->primaryKeyValue == $langSelectedID) {
            unset($langs[$key]);
            $langSelected = $lang;
        }
    }

    $setLangFile = $rootPath . "lang/setlang.php";
    $articlesFile = $rootPath . "articles.php";
    
    if($user) {
    ?>
        <nav>
            <a href="index.php" class="btn btn-top-second">Accueil</a>
            <a href="articles.php" class="btn btn-top-second">Articles</a>
            <a href="logout.php" class="btn btn-top-second">logout</a>
            <?php if($user->isAdmin()) { ?><a href="admin/index.php" class="btn btn-top-second">admin</a><?php } ?>
            <a href="profil.php" class="btn btn-top-main"><?= $user->firstname . " " . $user->lastname ?></a>
        </nav>
    <?php
    }else{
    ?>
        <nav>
            <div class="head">
                <div class="lang" id="lang-box">
                    <svg viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.0875 3.5791L5 5.48743L6.9125 3.5791L7.5 4.1666L5 6.6666L2.5 4.1666L3.0875 3.5791Z" fill="#FFEED3"/></svg>
                    <ul>
                    <li><a><?= substr($langSelected->values["Lib1Lang"],0,2); ?></a></li>
                        <?php 
                        foreach($langs as $lang) {
                            if($lang->primaryKeyValue != $langSelectedID) {
                        ?>
                            <li><a href="<?= $setLangFile ?>?id=<?= $lang->primaryKeyValue; ?>"><?= substr($lang->values["Lib1Lang"],0,2); ?></a></li>
                        <?php
                            }
                        }
                        ?>  
                    </ul>
                </div>
                <a href="register" class="btn"><?= $language->for("auth","startbutton") ?></a>
            </div>
            <ul class="links">
                <?php foreach($themes as $theme) { ?>
                    <li><a href="<?= $articlesFile ?>?id=<?= $theme->primaryKeyValue ?>" class="btn"><?= $theme->values["LibThem"] ?></a></li>
                <?php } ?>

            </ul>
            <script>
                langbox = document.getElementById("lang-box");
                langbox.addEventListener("click", function(event) {
                    langbox.classList.toggle("grow");
                })
            </script>
        </nav>
    <?php
    }
}
?>