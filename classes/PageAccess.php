<?php

class PageAccess
{
    
    public static function SaveAccess($page, $ip, $reference, $first_access){
        $db = new DB("page_access");
        $db->user_ip = $ip;
        $db->page = $page;
        $db->reference = $reference;
        $db->first_access = $first_access;
        $db->insert();
    }

}
