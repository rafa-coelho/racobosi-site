<?php

define('STRIP', 'STRIP');
define('REPLACE', 'REPLACE');

class Request
{
    
    public static function method()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
    
    public static function post($striptags=true, $method=STRIP){
        $o = new stdClass;
        foreach($_POST as $k => $v){
            if(is_string($v)){
                $o->$k = addslashes(($striptags) ? ($method == STRIP) ? strip_tags($v) : htmlspecialchars($v) : $v);
            } else if(is_array($v)) {
                $a = new stdClass;
                foreach($v as $kv => $vv)
                    $a->{$kv} = addslashes(($striptags) ? ($method == STRIP) ? strip_tags($vv) : htmlspecialchars($vv) : $vv);

                $o->{$k} = $a;
            }
        }
        return $o;
    }

    public static function files(){
        $o = new stdClass;
        foreach($_FILES as $k => $v){
            $file = $v;
            if(is_array($v)){
                $file = new stdClass;
                foreach($v as $key => $value){
                    $file->$key = $value;
                }
            }
            $o->$k = $file;
        }
        return $o;
    }

    public static function get(){
        $o = new stdClass;
        foreach($_GET as $k => $v)
            $o->$k = addslashes($v);
        return $o;
    }
    
    public static function body(){
        $o = new stdClass;
        $json = json_decode(file_get_contents('php://input'));
        if(!empty($json))
            foreach($json as $k => $v)
                $o->$k = addslashes($v);
        return $o;
    }
    
    public static function headers(){
        $o = new stdClass;
        foreach (getallheaders() as $k => $v)
            $o->$k = $v;
        return $o;
    }
    
    public static function redirect($url){	
        if (! headers_sent())
            header("Location: {$url}");
        else
            exit("<script type=\"text/javascript\" language=\"javascript\"> window.location.href='{$url}'/</script>");
    }
    
    
}