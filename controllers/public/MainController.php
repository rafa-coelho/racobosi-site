<?php

class MainController extends Controller
{

    public function __construct()
    {
        $this->views = new Template("Home");
    }

    public function Home()
    {
        $this->views->title = "Tela um";
        $this->views->display("home.phtml");

        if (!isset($_COOKIE["_ra"])) {
            setcookie("_ra", REQUEST_IP . "_", time() + YEAR_SECONDS, "/");
        }

        $reference = isset($_GET["ref"]) ? $_GET["ref"] : "";
        $firstAccess = !isset($_COOKIE["_ra"]) ? 1 : 0;

        PageAccess::SaveAccess($_SERVER["REDIRECT_URL"], REQUEST_IP, $reference, $firstAccess);
    }
}
