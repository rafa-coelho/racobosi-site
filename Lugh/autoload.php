<?php

function objCount($a){
    $c = 0;
    foreach($a as $v)
        $c++;
    return $c;
}

function objPosition($o, $i){
    $c = 0;
    foreach($o as $v){
        if($c == $i) return $v;
        $c++;
    }
    return null;
}

function inObject($find, $obj){
    foreach($obj as $k => $v){
        if($find == $k){
            return $v;
        }
    }
    return null;
}


function autoload($class){
    $file = dirname(__FILE__)."/classes/$class.php";
    
    if(file_exists($file))
        require_once($file);
    
    $classe = BASE."classes/$class.php";
    
    if(file_exists($classe))
        require_once($classe);
    
}

spl_autoload_register("autoload");
