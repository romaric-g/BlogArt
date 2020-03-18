<?php 

require_once("FormItem.php");

class TextArea extends FormItem {

    public $row = 3;
    public $first = "";

    public function row($row) : self {
        $this->row = $row;
        return $this;
    }

    public function HTML() : string
    {
        $feedClass = $this->feedback["type"] == "error" ? "invalid" : "valid";
        $html =  
        '<div class="form-group">
            <label for="'. $this->name .'">'. $this->label .'</label>
            <textarea class="form-control'. ($this->feedback? ( ' is-'. $feedClass ) : "") .'" id="'. $this->name .'" name="'. $this->name .'" rows="'. $this->row .'" placeholder="'. $this->label .'">' . $this->lastSubmitText() . '</textarea>';

        if($this->feedback)$html .= '<div class="' . $feedClass . '-feedback">'. $this->feedback["message"] . '</div>';
        $html .= '</div>';
        return $html;
    }
}

?>