<?php

class KeywordsInput {
    public $keywords= array();
    public $keywordsSelect = array();
    public $name = "Keywords";
    public $label = "Mots Clés";

    public function __construct($keywords)
    {
        $this->keywords = $keywords;
    }

    public function select($keywordsSelect) : self
    {
        $this->keywordsSelect = $keywordsSelect;
        return $this;
    }

    public function HTML() {
        return "";
    }

    public function print() {
        $this->printKeywordInput();
    }


    public function printKeywordInput() { 
?>
        <input type="hidden" name="<?= $this->name ?>" id="<?= $this->name ?>" >
        <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center"><?= $this->label ?><span id="keywordCount" class="badge badge-light badge-pill">0</span></li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <select class="custom-select" id="keyWordSelect">
                                        <?php foreach($this->keywords as $keyword) { ?>
                                            <option data-lang="<?= $keyword["NumLang"]?>" value="<?= $keyword["NumMoCle"] ?>"><?= $keyword["LibMoCle"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <a href="#" class="btn btn-info" id="addKeyWordButton">Ajouter</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <ul class="list-group list-group-flush" id="keyWordList">
                                <?php foreach($this->keywordsSelect as $keyword) { ?>
                                    <li data-value="<?= $keyword->primaryKeyValue ?>" data-lib="<?= $keyword->values["LibMoCle"] ?>"></li>
                                <?php } ?>                          
                            </ul>
                        </li>
        </ul>
        <script src="./../js/keyword.js"></script>
<?php 
    }

}?>