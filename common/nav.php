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
    ?>
        <nav>
            <div class="head">
                <div class="lang" id="lang-box">
                    <svg viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.0875 3.5791L5 5.48743L6.9125 3.5791L7.5 4.1666L5 6.6666L2.5 4.1666L3.0875 3.5791Z"/></svg>
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
               
    <?php if($user) { ?>
            <div class="btn btn-logout">
                <a href="actions/logout.php">Déconnexion</a>
            </div>
            <div class="btn btn-member">
                <a href="profil"><?= $user->firstname . " " . substr($user->lastname, 0, 1) . "."; ?></a>
            </div>
    <?php }else{ ?>
            <div class="btn btn-member">
                <a href="login.php"><?= $language->for("auth","startbutton") ?></a>
            </div>
    <?php } ?>
           </div>
            <ul class="links" id="links">
                <li><a href="<?= $rootPath ?>index.php" class="btn">Home</a></li>
                <?php foreach($themes as $theme) { ?>
                    <li><a href="<?= $articlesFile ?>?id=<?= $theme->primaryKeyValue ?>" class="btn"><?= $theme->values["LibThem"] ?></a></li>
                <?php } ?>
                <span></span>
            </ul>
            <script>
                langbox = document.getElementById("lang-box");
                langbox.addEventListener("click", function(event) {
                    langbox.classList.toggle("grow");
                })

                links = document.getElementById("links");
                span = null;
                for (const elemt of links.children) {
                    if(elemt.tagName === "SPAN")span = elemt;
                }
                width = 0;
                opacity = 0;
                bottom = -4;
                document.addEventListener('mousemove', function(event) {
                    for (const li of links.children) {
                        if(li.tagName === "LI" && li.parentElement.querySelector(':hover') === li) {
                            left = (li.offsetLeft) + 25;
                            width = (li.children[0].clientWidth);
                            bottom = links.offsetHeight - li.offsetHeight - li.offsetTop;
                            opacity = 1;
                            break;
                        }
                        bottom = -4;
                        opacity = 0;
                        left = "unset";
                    }
                    span.style.left = left + "px";
                    span.style.bottom = bottom + "px";
                    span.style.width = width + "px";
                    span.style.opacity = opacity;
                })
            </script>
        </nav>
    <?php
}
?>