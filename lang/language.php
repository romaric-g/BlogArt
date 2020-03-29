<?php

class Language {

    public $langID;
    public $rootPath;
    public $content;

    public function __construct($langID, $rootPath)
    {
        $this->langID = $langID;
        $this->rootPath = $rootPath;
        $this->load();
    }

    public function load() {
        $fileName = $this->rootPath . "lang/$this->langID.json";
        if (file_exists($fileName)) {
            $string = file_get_contents($fileName);
            $this->content = json_decode($string, true);
        }else{
            throw new Exception("lang file desn't exist!");
        }
    }

    public function for(...$entries) {
        $lastGet = $this->content;
        foreach ($entries as $entry) {
            if(isset($lastGet[$entry])) {
                $lastGet = $lastGet[$entry];
            }else{
                return "";
            }
        }
        return $lastGet;
    }

    public static function INIT($langID, $rootPath) : self {
        try {
            $LANGUAGE = new self($langID, $rootPath);
        } catch (\Exception $exception) {
            $_SESSION["LANG"] = "FRAN01";
            header("Location: $rootPath"."index.php");
            exit();
        }
        return $LANGUAGE;
    }

    public static function AVAILABLE($langID, $rootPath) {
        $fileName = $rootPath . "lang/$langID.json";
        return file_exists($fileName);
    }
}

?>