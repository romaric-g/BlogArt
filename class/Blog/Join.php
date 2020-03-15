<?php

class Join {
    
    public const INNER = "INNER";
    public const LEFT = "LEFT";
    public const RIGHT = "RIGHT";
    public const FULL = "FULL";

    private $jointable;
    private $joinkey;
    private $targetkey;
    private $type;

    public function __construct($jointable, $joinkey, $targetkey, $type = self::INNER)
    {
        $this->jointable = $jointable;
        $this->joinkey = $joinkey;
        $this->targetkey = $targetkey;
        $this->type = $type;
    }

    public function getJoinLine(string $targettable) : string
    {
        return $this->type . " JOIN " . $this->jointable . " ON " . $targettable . "." . $this->targetkey . " = " . $this->jointable . "." . $this->targetkey; 
    }
}
?>