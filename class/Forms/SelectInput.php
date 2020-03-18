<?php 

require_once("FormItem.php");

class SelectInput extends FormItem {

    public $array;

    public $valueKey;
    public $libKey;

    public $selected = NULL;

    public function set($array,$valueKey, $libKey) : self  {
        $this->array = $array;
        $this->valueKey = $valueKey;
        $this->libKey = $libKey;
        return $this;
    }

    public function select($selected) : self {
        $this->selected = $selected;
        return $this;
    }

    private function getSelect($value){
        if(!$this->selected)return false;
        return ($value == $this->selected ? 'selected' : '');
    }

    private function getValue($option) {
        return $option[$this->valueKey];
    }
    private function getLib($option) {
        return $option[$this->libKey];
    }
    

    public function HTML() : string
    {
        $html =  
        '<div class="input-group-prepend">
            <label class="input-group-text" for="' . $this->name . '">' . $this->label . '</label>
        </div>
        <select class="custom-select" name="' . $this->name . '" id="' . $this->name . '">';

        while($option = $this->array->fetch()){ 
            $value = $this->getValue($option);
            $html .= '<option value="' . $value . '" ' . $this->getSelect($value) .'>' . $this->getLib($option) .'</option>';
        }
        $html .= '</select>';
        return $html;
    }
}

?>