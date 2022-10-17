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
}
