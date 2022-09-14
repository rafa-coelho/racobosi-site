<?php

class MainController extends Controller
{
    
    public function __construct(){
        $this->views = new Template("Home", "index");
    }
    
    public function Home(){
        $this->views->title = "Dashboard";
        $this->views->display("home.phtml");
    }
    
    
}
