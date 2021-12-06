<?php

class Session
{
//    public $data;
//    private $session_id;
    
    public function __construct(){
        $session_id = session_id(); 
        if(empty($session_id))
            session_start();

//        $this->session_id = session_id();
		
//        $this->data = array();
        foreach($_SESSION as $k => $v)
            $this->$k = $v;
        
    }
    
    public function __set($k, $v){
        $_SESSION[$k] = $v;
        $this->$k = $v;
    }
    
    public function destroy($k=null){
        if(!is_null($k)){
            unset($_SESSION[$k]);
            unset($this->data[$k]);
        }else{	
            session_unset();
            session_destroy();
            unset($_SESSION);
//            unset($this);
        }
    }
    
}