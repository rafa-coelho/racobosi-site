<?php

class AnalyticsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->views = new Template("Home");
    }

    public static function RegisterAccess()
    {
        $access = PageAccess::GetAccess(REQUEST_IP);

        if ($access == false) {
            $reference = isset($_GET["ref"]) ? $_GET["ref"] : "";
            PageAccess::SaveAccess($_GET["path"], REQUEST_IP, $reference);
        } else {
            PageAccess::UpdateAccess($access->id, intval($access->access_count) + 1);
        }
    }
}
