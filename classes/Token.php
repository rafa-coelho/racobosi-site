<?php

class Token
{
    
    public static function GetByToken($token){
        $db = new DB("tokens");
        $db->where("token = '$token'");

        $tokenFound = $db->get();

        return $tokenFound == false ? null : $tokenFound;
    }

}
