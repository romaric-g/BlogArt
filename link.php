<?php

function getLink($link) {  
    $path = strtolower($_SERVER["CONTEXT_DOCUMENT_ROOT"]);
    $link = strtolower("$link");
    $dir = strtolower(str_replace("\\", "/" , __DIR__));

    $root =  str_replace($path, "", $dir);

    $rootLink = $root  . $link;
    return $rootLink;
}

?>