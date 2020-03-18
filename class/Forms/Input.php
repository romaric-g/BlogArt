<?php 

require_once("FormItem.php");

class Input extends FormItem {

    public $maxlength = "";
    public $first = "";

    public function max($maxlength) : self {
        $this->maxlength = 'maxlength="'. $maxlength .'"';
        return $this;
    }
    public function first() : self
    {
        $this->first = "autofocus";
        return $this;
    }

    public function HTML() : string
    {
        $feedClass = $this->feedback["type"] == "error" ? "invalid" : "valid";
        $html = 
        '<div class="form-group has-success">
                <label for="'. $this->name .'">'. $this->label .'</label>
                <input type="text" class="form-control' . ($this->feedback? ( ' is-'. $feedClass ) : "") . '" id="'. $this->name .'" name="'. $this->name .'" '. $this->maxlength .' placeholder="'. $this->label .'" ' . ($this->first) . ' value="' . $this->lastSubmitText() . '">';
        if($this->feedback)$html .= '<div class="' . $feedClass . '-feedback">'. $this->feedback["message"] . '</div>';
        $html .= '</div>';
        return $html;
    }
}

?>