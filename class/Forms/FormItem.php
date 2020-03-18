<?php 

abstract class FormItem {

    public $name;
    public $label;

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

        
    public $feedback;
    public $lastSubmit;

    public function feedback($feedbacks, $post) : self
    {
         $this->feedback = isset($feedbacks) ? $feedbacks[$this->name] : NULL;
         $this->lastSubmit = ($post && isset($post[$this->name])) ? $post[$this->name] : "";
         return $this;
    }

    public function lastSubmitText() {
        if($this->lastSubmit) {
            return $this->lastSubmit;
        }
        return "";
    }

    public abstract function HTML() : string; 

}

?>