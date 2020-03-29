<?php 

require_once("FormItem.php");

class UploadImage extends FormItem {

    public $root = "./";

    public function setRoot($root) : self {
        $this->root = $root;
        return $this;
    }

    public function HTML() : string
    {
        $feedClass = null;
        $lastSubmit = $this->lastSubmitText();
        if($this->feedback)$feedClass = $this->feedback["type"] == "error" ? "invalid" : "valid";
        $html =  
        '<div class="form-group">';
        if($lastSubmit)$html .= '<img src="' . $this->root . "uploads/articles/" . $lastSubmit . '" class="img-fluid rounded float-left" alt="Responsive image" style="width: 200px">';
        $html .= 
            '<div class="custom-file">
                <input type="file" class="custom-file-input'. ($this->feedback? ( ' is-'. $feedClass ) : "") .'" id="'. $this->name .'" name="'. $this->name .'" ">
                <label class="custom-file-label" for="' .  $this->name . '">' . $this->label . '</label>';

                if($this->feedback)$html .= '<div class="' . $feedClass . '-feedback">'. $this->feedback["message"] . '</div>';
        $html .= 
            '</div>
        </div>';
        if($lastSubmit)$html .= '<input type="hidden" name="'. $this->name .'" value="' . $this->lastSubmitText() . '">';
        return $html;
    }
}

?>