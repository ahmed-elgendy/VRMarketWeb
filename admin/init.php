<?php
include 'config.php';
$tpl = "includes/templates/";
$lang = "includes/languages/";
$css = "layout/css/";
$js = "layout/js/";
$fun = "includes/functions/";

//include important files
include $fun . "function.php";
include $lang . "english.php";
include $tpl . "header.php"; 
include $tpl . "footer.php";

//include navbar on all pages expect the one with $noNavbar 
if(!isset($noNavbar)){
include $tpl . "navbar.php"; 
}

