<?php

class PageAccess
{
    public static function IsFirstAccess($ip)
    {
        $db = new DB("page_access");
        $db->where("user_ip = '$ip'");
        $found = $db->get();
        return ($found == false) ? true : false;
    }

    public static function GetAccess($ip)
    {
        $db = new DB("page_access");
        $db->where("user_ip = '$ip'");
        return $db->get();
    }

    public static function SaveAccess($page, $ip, $reference){
        $db = new DB("page_access");
        $db->user_ip = $ip;
        $db->page = $page;
        $db->reference = $reference;
        $db->access_count = 1;
        $db->insert();
    }

    public static function UpdateAccess($id, $access_count)
    {
        $db = new DB("page_access");
        $db->where("id = '$id'");
        $db->access_count = $access_count;
        $db->update();
    }

}
