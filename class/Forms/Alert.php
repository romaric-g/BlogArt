<?php

class Alert {

    public $fbmsg;

    public function __construct($fbmsg)
    {
        $this->fbmsg = $fbmsg;
    }

    public function HTML() {
        $error = NULL;
        $success = NULL;
        if(isset($this->fbmsg["error"]))$error = $this->fbmsg["error"];
        if(isset($this->fbmsg["success"]))$success = $this->fbmsg["success"];
        if(!$error && !$success)return "";
        $type = ($error ? "danger" : "success");
        $message = $error ? $error : $success;
        return '<div class="alert alert-'. $type .'" role="alert">'. $message .'</div>';
    }
}

?>