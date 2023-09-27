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
    }

    public function Notifications(){
        echo "ok";
        http_response_code(200);
        return;
    }
}
