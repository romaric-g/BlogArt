<?php function printArticleCard($article, $LANGUAGE, $keywords, $imageURL) { ?>
    <article class="article-card row justify-content-center">
        <div class="article-illu col-md-4">
            <img src="<?= $imageURL ?>" alt="">
        </div>
        <div class="article-content col-md-6">
            <div class="title">
                <p><?= $article->values["LibTitrA"] ?></p>
            </div>
            <div class="text">
                <p><?= $article->values["LibChapoA"] ?></p>
            </div>
            <div class="keywords">
                <ul>
                    <?php foreach($keywords as $keyword) { ?>
                        <li><?= $keyword->values["LibMoCle"]; ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="link">
                <a href="article.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-read"><?= $LANGUAGE->for("article","read") ?></a>
            </div>
        </div>
    </article>
<?php } ?>