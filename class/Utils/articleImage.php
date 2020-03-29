<?php 

function getArticleImageUrl($root, $image) {
    $url = $image;
    if(strpos($url,"http") === false) {
        $url = $root . "uploads/articles/" . $url;
    }
    return $url;
}

?>