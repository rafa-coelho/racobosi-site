<?php
    //error_reporting( E_ALL ); 

    header('Access-Control-Allow-Origin: *');
    define("BASE", "");

    require("settings.php");
    require(BASE . "lugh/Lugh.php");
    require("urls.php");
    new Lugh();
