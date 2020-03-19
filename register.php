<?php 

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");

$registerError = array();

function printFeedback($name) {
    global $registerError;
    if(!empty($registerError)) {
        $set = isset($registerError[$name])
?>
        <div class="<?= $set ? "invalid" : "valid"; ?>-feedback"><?= $set ? $registerError[$name] : "saisie valide" ?></div>
<?php
    }
}
function getFeedbackClass($name) {
    global $registerError;
    if(!empty($registerError)) {
        return " is-" . (isset($registerError[$name]) ? "invalid" : "valid");
    }
}
function getSet($name) {
    return ctrlSaisies(isset($_POST[$name]) ? $_POST[$name] : "");
}



if($_SERVER["REQUEST_METHOD"] == "POST") {

    $requiredParams = array("email","firstname","lastname","password","passwordconfirm");
    $maxLength = array(50,30,30,15,15);
    $i = 0;
    foreach($requiredParams as $param){
        if(!isset($_POST[$param]) || empty($_POST[$param])) {
            $registerError[$param] = "Ce champ est obligatoire";
        }else{
            if( strlen($_POST[$param]) > $maxLength[$i]){
                $registerError[$param] = "Champ limité à ". $maxLength[$i] . " caractères";
            }
        }
        $i++;
    }
    if( !isset($registerError["email"]) && !preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $_POST["email"])) { 
        $registerError["email"] = "Adresse email invalide";
    }
    if( !isset($requiredParams["password"]) && !isset($requiredParams["passwordconfirm"]) && $_POST["password"] != $_POST["passwordconfirm"] ) {
        $registerError["passwordconfirm"] = "Les mots de passe ne corresponde pas";
    }
    if(!isset($_POST["conditions"])) {
        $registerError["conditions"] = "Vous devez accepter nos conditions";
    }

    if(empty($registerError)) {
        try {
            $user = User::new($_POST["email"],$_POST["firstname"],$_POST["lastname"],$_POST["password"],$conn);
        } catch (\Exception $ex) {
         
        }
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/auth.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <div style="position: absolute; height: 0;">
        <svg>
            <defs>
                <clipPath id="svgPath" clipPathUnits="objectBoundingBox">
                    <path d="M0,1 V0 S0.93,0,0.928,0 C1,0.422,0.159,0.466,0.776,1"/>
                </clipPath>
            </defs>
        </svg>
    </div>
    <header class="container-fluid">
        <div class="row justify-content-end">
            <div class="header-left col-md-5">
                <div class="content">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.05 342.94"><defs><style>.cls-1{fill:#2b2b2b;}.cls-2{fill:none;stroke:#e3b04b;stroke-linecap:round;stroke-miterlimit:10;stroke-width:13px;}.cls-3{fill:#e2a539;}</style></defs><title>LPB-nobackground</title><path class="cls-1" d="M376.88,158.9A154.36,154.36,0,0,0,254.49,98.79h0a154.68,154.68,0,1,0,0,309.35h0A154.67,154.67,0,0,0,376.88,158.9Z" transform="translate(-84.47 -82)"/><path class="cls-1" d="M316.36,102.28a4.37,4.37,0,0,1-1.57-.3,162.32,162.32,0,0,0-60.3-11.53,163.47,163.47,0,0,0-43,5.74,161.79,161.79,0,0,0-17.3,5.79,4.23,4.23,0,0,1-3.13-7.85,171.55,171.55,0,0,1,126.86,0,4.23,4.23,0,0,1-1.56,8.15Z" transform="translate(-84.47 -82)"/><path class="cls-1" d="M154.09,391.45a4.21,4.21,0,0,1-2.53-.85,171.5,171.5,0,0,1-67-114.5A4.22,4.22,0,1,1,92.88,275a163.12,163.12,0,0,0,63.75,108.86,4.22,4.22,0,0,1-2.54,7.6ZM88.7,235.59l-.56,0a4.22,4.22,0,0,1-3.63-4.74,171.55,171.55,0,0,1,67.07-114.5,4.23,4.23,0,0,1,5.07,6.76A163.1,163.1,0,0,0,92.88,231.92,4.21,4.21,0,0,1,88.7,235.59Z" transform="translate(-84.47 -82)"/><path class="cls-1" d="M254.49,424.94a170.84,170.84,0,0,1-63.42-12.13,4.22,4.22,0,0,1,3.12-7.85,163,163,0,0,0,120.6,0,4.23,4.23,0,0,1,3.13,7.85,171,171,0,0,1-63.43,12.13Z" transform="translate(-84.47 -82)"/><path class="cls-1" d="M354.87,391.47a4.23,4.23,0,0,1-2.54-7.61A163.1,163.1,0,0,0,416.1,275a4.22,4.22,0,0,1,8.37,1.11A171.56,171.56,0,0,1,357.4,390.62,4.21,4.21,0,0,1,354.87,391.47Zm65.41-155.85A4.22,4.22,0,0,1,416.1,232a163.12,163.12,0,0,0-63.75-108.86,4.22,4.22,0,0,1,5.08-6.75,171.6,171.6,0,0,1,67.05,114.51,4.23,4.23,0,0,1-3.64,4.74A5.12,5.12,0,0,1,420.28,235.62Z" transform="translate(-84.47 -82)"/><path class="cls-2" d="M400.51,345.47" transform="translate(-84.47 -82)"/><path class="cls-3" d="M179.39,283.9c12.43,2.74,25,15.41,40.15,15.41a25.82,25.82,0,0,0,10-1.91c-1.2,11.47-6,18.76-12.43,18.76C200.07,316.16,185,289,163.86,289a21.09,21.09,0,0,0-2.75.12l17.81-82.8c-10.4,4.3-16.73,13.26-16.73,26,0,6.1,1.55,7.05,1.67,8.13-8.24,0-12.79-3-12.79-11.59,0-15.89,22-31.07,42-31.07,1.67,0,3.22.12,4.78.24Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M246.79,207.9l-8.49,39.91c12.07-1,20.91-16.61,20.91-29.4,0-8.84-4.3-16.25-14.81-16.25-19.36,0-31,10.88-31,29,0,6.09,1.55,7.05,1.67,8.13-8.24,0-12.78-3-12.78-11.6,0-15.89,22-31.06,41.94-31.06,19.59,0,28.2,11.23,28.2,23.54,0,15.17-13,32-34.54,32h-.59l-7.29,34H212.85l16.25-76Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M321.23,207.9l-5.62,26.53h.72c9.56,0,17.2-10.4,17.2-19.36,0-6.81-4.42-12.91-15.77-12.91-14,0-29.87,9.32-29.87,29,0,6.09,1.55,7.05,1.67,8.13-7.88,0-12.78-3-12.78-11,0-16.49,20.79-31.66,43.37-31.66,17.57,0,25.45,9.2,25.45,19,0,7.05-4.18,14.57-12,19,10.16,2,14.1,10.27,14.1,19.23,0,11.47-6.21,34.42-26.16,34.42-5.14,0-11.83-1.56-11.83-8.85a19.23,19.23,0,0,1,1.55-6.93c3,3.11,5.26,4.3,8,4.3,8.72,0,11.82-12.42,11.82-21.5,0-8.37-2.62-15.18-11.35-15.18-1,0-3.34.12-5.49.36l-9.8,45.76H287.29l16.25-76Z" transform="translate(-84.47 -82)"/><circle class="cls-3" cx="230.51" cy="185.76" r="3.23"/><circle class="cls-3" cx="236.4" cy="181.63" r="1.5"/><circle class="cls-3" cx="234.24" cy="177.35" r="0.98"/><circle class="cls-3" cx="107.34" cy="98.34" r="4.88"/><circle class="cls-3" cx="120.25" cy="92.28" r="2.21"/><circle class="cls-3" cx="121.23" cy="83.87" r="0.99"/><circle class="cls-3" cx="126.68" cy="161.77" r="2.62"/><circle class="cls-3" cx="122.53" cy="166.49" r="1.44"/><circle class="cls-3" cx="123.41" cy="169.97" r="0.83"/><path class="cls-3" d="M157.23,343c2.17.48,4.36,2.69,7,2.69a4.48,4.48,0,0,0,1.75-.33c-.21,2-1,3.27-2.17,3.27-3,0-5.61-4.73-9.3-4.73a3.77,3.77,0,0,0-.48,0l3.11-14.46a4.62,4.62,0,0,0-2.93,4.55,2.9,2.9,0,0,0,.3,1.42c-1.44,0-2.24-.52-2.24-2,0-2.77,3.84-5.42,7.33-5.42.29,0,.56,0,.83,0Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M171.12,333l-1.5,7.09a3,3,0,0,0-.08.67c0,.58.27.77.85.77a1.08,1.08,0,0,0,.46-.08c-.56,1.46-1,2.1-2.08,2.1a2,2,0,0,1-2.05-1.94,3.76,3.76,0,0,1-3.11,1.94c-1.42,0-2.77-.87-2.77-3.36,0-2.81,1.73-7.3,5.36-7.3,1.19,0,1.69.46,1.69,1.07v.14l.23-1.1Zm-7.19,6.9c0,1.61.66,1.63,1,1.63a2.11,2.11,0,0,0,1.73-1.84l1-4.71a.81.81,0,0,0-.85-.79C165.07,334.2,163.93,338,163.93,339.91Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M185.35,329.75l-1.48,7c2.11-.17,3.65-2.9,3.65-5.13,0-1.55-.75-2.84-2.59-2.84-3.38,0-5.4,1.9-5.4,5.07a3,3,0,0,0,.29,1.42c-1.44,0-2.23-.52-2.23-2,0-2.78,3.84-5.43,7.32-5.43s4.93,2,4.93,4.11a5.83,5.83,0,0,1-6,5.59h-.11l-1.27,5.95h-3l2.83-13.27Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M194.89,333l-.27,1.29a4,4,0,0,1,2.52-1.29,1.54,1.54,0,0,1-.06,3.08c-1.17,0-.59-1.37-1.21-1.37a2.17,2.17,0,0,0-1.53.79l-1.66,7.93h-3L191.88,333Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M203.67,341.81c1.65,0,2.65-.92,3.69-2.11h.71c-1.19,1.92-3,3.86-5.74,3.86-2,0-3.25-1-3.25-3.31s1.36-7.43,5.63-7.43c1.86,0,2.3,1,2.3,2,0,2.4-2.3,4.26-4.8,4.4,0,.3,0,.59,0,.84C202.17,341.48,202.67,341.81,203.67,341.81Zm1.21-7.89c-1.06,0-2.09,2.24-2.5,4.3a3.49,3.49,0,0,0,3-3.44C205.4,334.26,205.28,333.92,204.88,333.92Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M217.25,339.7a12.13,12.13,0,0,1-3.19,2.61,4.6,4.6,0,0,1-3.28,1.25,2.72,2.72,0,0,1-3-2.67,2.14,2.14,0,0,1,1.1-1.94,31.6,31.6,0,0,0,2.57-6.17l3.09-.42c.25,5.4.46,6.22.46,7.59a2.88,2.88,0,0,1-.09.8,11.6,11.6,0,0,0,1.51-1.05Zm-7.84,1a.62.62,0,0,1-.57-.28c0,1,.36,1.47,1.28,1.47a1.71,1.71,0,0,0,1.81-1.94c0-1.09-.19-1.74-.4-5a23.55,23.55,0,0,1-1.68,3.94.79.79,0,0,1,.47.73A1,1,0,0,1,209.41,340.73Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M226.26,339.7a12.13,12.13,0,0,1-3.19,2.61,4.58,4.58,0,0,1-3.27,1.25,2.73,2.73,0,0,1-3.05-2.67,2.13,2.13,0,0,1,1.11-1.94,31.54,31.54,0,0,0,2.56-6.17l3.09-.42c.25,5.4.46,6.22.46,7.59a3.34,3.34,0,0,1-.08.8,12.16,12.16,0,0,0,1.5-1.05Zm-7.84,1a.6.6,0,0,1-.56-.28c0,1,.35,1.47,1.27,1.47a1.71,1.71,0,0,0,1.81-1.94c0-1.09-.18-1.74-.39-5a23.61,23.61,0,0,1-1.69,3.94.8.8,0,0,1,.48.73A1,1,0,0,1,218.42,340.73Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M230.85,333l-1.5,7.09a3,3,0,0,0-.08.67c0,.58.27.77.85.77.82,0,1.57-.79,1.88-1.84h.88c-1.19,3.4-3.26,3.86-4.38,3.86s-2.24-.75-2.24-2.5a7.2,7.2,0,0,1,.17-1.36l1.42-6.69Zm-.93-4.45a1.67,1.67,0,0,1,1.66,1.67,1.66,1.66,0,1,1-1.66-1.67Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M241.14,336.16a.51.51,0,0,0,.23,0,6.7,6.7,0,0,0,3.21-1.25l.19.56a6.55,6.55,0,0,1-3.69,1.73c-.34,3.86-2.42,6.28-5,6.28-1.94,0-3.34-.92-3.34-3.29s1.42-7.41,5.72-7.41C240.26,332.82,241.14,334,241.14,336.16Zm-1.79,1.14c-.44-.1-.57-.45-.57-.87a1.14,1.14,0,0,1,.65-1.13c0-.87-.25-1.21-.79-1.21-1.49,0-2.78,3.82-2.78,5.86,0,1.38.27,1.69,1.07,1.69C238,341.64,239,339.77,239.35,337.3Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M248.5,334.82c-.75,0-1.31.88-1.62,1.92l-1.42,6.7h-3L244.67,333h3l-.23,1.08a3.11,3.11,0,0,1,2.44-1.17,2.11,2.11,0,0,1,2.32,2.36c0,1.69-1,4.22-1,5.38,0,.53.2.88.83.88a1.24,1.24,0,0,0,.69-.13,2.22,2.22,0,0,1-2.3,2.15c-1.6,0-2.1-1.16-2.1-2.35,0-1.42.94-4,.94-5.32C249.26,335.2,249,334.82,248.5,334.82Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M267.22,329.75l-1,4.63h.12c1.67,0,3-1.81,3-3.38,0-1.19-.77-2.25-2.76-2.25a5,5,0,0,0-5.21,5.07,3,3,0,0,0,.29,1.42c-1.38,0-2.23-.52-2.23-1.92,0-2.88,3.63-5.53,7.57-5.53,3.07,0,4.44,1.61,4.44,3.32a4,4,0,0,1-2.08,3.32,3.09,3.09,0,0,1,2.46,3.35c0,2-1.08,6-4.57,6-.9,0-2.06-.27-2.06-1.54a3.34,3.34,0,0,1,.27-1.21,1.88,1.88,0,0,0,1.39.75c1.53,0,2.07-2.17,2.07-3.76s-.46-2.64-2-2.64c-.17,0-.59,0-1,.06l-1.71,8h-3l2.84-13.27Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M281.72,336.16a.51.51,0,0,0,.23,0,6.7,6.7,0,0,0,3.21-1.25l.19.56a6.55,6.55,0,0,1-3.69,1.73c-.34,3.86-2.42,6.28-5,6.28-1.94,0-3.34-.92-3.34-3.29s1.42-7.41,5.72-7.41C280.84,332.82,281.72,334,281.72,336.16Zm-1.8,1.14c-.43-.1-.56-.45-.56-.87a1.14,1.14,0,0,1,.65-1.13c0-.87-.25-1.21-.8-1.21-1.48,0-2.77,3.82-2.77,5.86,0,1.38.27,1.69,1.06,1.69C278.53,341.64,279.59,339.77,279.92,337.3Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M288.25,333,288,334.3A4,4,0,0,1,290.5,333a1.54,1.54,0,0,1-.06,3.08c-1.17,0-.59-1.37-1.21-1.37a2.14,2.14,0,0,0-1.52.79L286,343.44h-3L285.24,333Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M303.6,328.83l-2.4,11.27a3,3,0,0,0-.08.67c0,.58.27.77.86.77.81,0,1.37-.79,1.69-1.84h.87c-1.19,3.4-3.06,3.74-4.19,3.74a1.92,1.92,0,0,1-2.05-1.8,3.69,3.69,0,0,1-3.08,1.92c-1.42,0-2.78-.87-2.78-3.36,0-2.81,1.73-7.3,5.36-7.3,1.19,0,1.69.46,1.69,1.07v.08l1-4.8Zm-5.32,10.87,1-4.77a.84.84,0,0,0-.86-.73c-1.77,0-2.92,3.75-2.92,5.71,0,1.61.67,1.63,1,1.63a2,2,0,0,0,1.71-1.73Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M309,341.81c1.65,0,2.65-.92,3.69-2.11h.71c-1.19,1.92-3,3.86-5.74,3.86-2,0-3.25-1-3.25-3.31s1.35-7.43,5.63-7.43c1.86,0,2.3,1,2.3,2,0,2.4-2.3,4.26-4.8,4.4,0,.3,0,.59,0,.84C307.53,341.48,308,341.81,309,341.81Zm1.21-7.89c-1.07,0-2.09,2.24-2.51,4.3a3.49,3.49,0,0,0,3-3.44C310.76,334.26,310.63,333.92,310.24,333.92Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M319.08,328.83l-2.4,11.27a3,3,0,0,0-.08.67c0,.58.27.77.86.77.81,0,1.56-.79,1.87-1.84h.88c-1.19,3.4-3.25,3.86-4.38,3.86s-2.23-.75-2.23-2.5a7.12,7.12,0,0,1,.16-1.36L316,329.25Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M330.39,333l-1.5,7.09a3,3,0,0,0-.08.67c0,.58.27.9.85.9.81,0,1.38-.92,1.69-2h.88c-1.19,3.4-3.07,3.86-4.2,3.86a1.91,1.91,0,0,1-2-1.92,3.78,3.78,0,0,1-3.11,1.92c-1.42,0-2.77-.87-2.77-3.36,0-2.81,1.73-7.3,5.36-7.3,1.19,0,1.69.46,1.69,1.07v.14l.23-1.1Zm-7.2,6.9c0,1.61.67,1.63,1.05,1.63A2.11,2.11,0,0,0,326,339.7l1-4.71a.81.81,0,0,0-.86-.79C324.34,334.2,323.19,338,323.19,339.91Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M336.82,333l-1.51,7.09a3,3,0,0,0-.08.67c0,.58.27.77.86.77.81,0,1.56-.79,1.87-1.84h.88c-1.19,3.4-3.25,3.86-4.38,3.86s-2.23-.75-2.23-2.5a7.12,7.12,0,0,1,.16-1.36l1.42-6.69Zm-.94-4.45a1.67,1.67,0,0,1,1.67,1.67,1.66,1.66,0,0,1-1.67,1.65,1.64,1.64,0,0,1-1.65-1.65A1.66,1.66,0,0,1,335.88,328.56Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M347.85,339.7a12.13,12.13,0,0,1-3.19,2.61,4.58,4.58,0,0,1-3.27,1.25,2.73,2.73,0,0,1-3.05-2.67,2.13,2.13,0,0,1,1.11-1.94,31.54,31.54,0,0,0,2.56-6.17l3.09-.42c.25,5.4.46,6.22.46,7.59a3.34,3.34,0,0,1-.08.8,12.16,12.16,0,0,0,1.5-1.05Zm-7.84,1a.6.6,0,0,1-.56-.28c0,1,.35,1.47,1.27,1.47a1.71,1.71,0,0,0,1.81-1.94c0-1.09-.18-1.74-.39-5a23.61,23.61,0,0,1-1.69,3.94.8.8,0,0,1,.48.73A1,1,0,0,1,340,340.73Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M352.11,341.58a4.29,4.29,0,0,0,2.46-1.1,3.35,3.35,0,0,1-3.61,3.08c-1.94,0-3.23-1-3.23-3.31s1.35-7.43,5.63-7.43c1.86,0,2.3,1,2.3,2,0,2.42-2.3,4.26-4.8,4.4,0,.21,0,.44,0,.63C350.82,341.16,351.38,341.58,352.11,341.58Zm1.42-7.66c-1,0-2.09,2.32-2.53,4.3a3.46,3.46,0,0,0,3.05-3.44C354.05,334.26,353.92,333.92,353.53,333.92Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M342.41,349.58,180,348.73l162.45-.84a.85.85,0,0,1,0,1.69Z" transform="translate(-84.47 -82)"/><path class="cls-3" d="M244.18,297.59,325,299.71l-80.85,2.11a2.12,2.12,0,1,1-.11-4.23Z" transform="translate(-84.47 -82)"/></svg>
                </div>
            </div>
            <div class="header-right col-md-7">
                <nav>
                    <a href="#" class="btn btn-top-second">Se connecter</a>
                    <a href="#" class="btn btn-top-main">S'inscrire</a>
                </nav>
                <div class="container content">
                    <div class="form-box">
                            <h1 class="title">Inscrivez-Vous</h1>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control<?= getFeedbackClass("firstname") ?>" name="firstname" placeholder="First name" value="<?= getSet('firstname') ?>">
                                            <?php printFeedback("firstname"); ?>
                                        </div>
                                        <div class="col">
                                            <label for="lastname">Last name</label>
                                            <input type="text" class="form-control <?= getFeedbackClass("lastname") ?>" name="lastname" placeholder="Last name" value="<?= getSet('lastname') ?>">
                                            <?php printFeedback("lastname"); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control <?= getFeedbackClass("email") ?>" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?= getSet('email') ?>">
                                    <?php printFeedback("email"); ?>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control<?= getFeedbackClass("password") ?>" name="password" placeholder="Password" value="<?= getSet('password') ?>">
                                            <?php printFeedback("password"); ?>
                                        </div>
                                        <div class="col">
                                            <label for="passwordconfirm">Repeat Password</label>
                                            <input type="password" class="form-control<?= getFeedbackClass("passwordconfirm") ?>" name="passwordconfirm" placeholder="Repeat Password" value="<?= getSet('passwordconfirm') ?>">
                                            <?php printFeedback("passwordconfirm"); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input is-invalid" type="checkbox" name="conditions" id="gridCheck">
                                        
                                        <label class="form-check-label" for="gridCheck">
                                            J'ai lu et j'accepte les Conditions Générales d'Utilisation et la Politique de Protection des Données Personnelles.
                                        </label>
                                        <?php 
                                            if(isset($registerError["conditions"])) {
                                        ?>
                                            <div class="invalid-feedback"><?= $registerError["conditions"] ?></div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-inscription">S'inscrire</button>
                                <p class="already-accound">Vous avez déjà un compte ? <br><a href="login">Connectez-vous</a></p>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </header>
    <main>

    </main>
</body>
</html>