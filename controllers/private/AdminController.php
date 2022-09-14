<?php

class AdminController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->views = new Template("Dashboard");
    }

    public function Dashboard()
    {
        $this->views->title = "Dashboard";
        $this->views->display("dashboard.phtml");
    }

    public function RequestList()
    {
        $this->views->title = "Chamados";
        $this->views->display("request/requestList.phtml");
    }

    public function ViewRequest()
    {
        $this->views->title = "Chamado - " . $this->get->code;
        $this->views->data = new stdClass();
        
        $this->views->data->code = $this->get->code;
        
        $this->views->display("request/viewRequest.phtml");
    }

    public function CustomerList()
    {
        $this->views->title = "Clientes";
        $this->views->display("customers/customerList.phtml");
    }
}
