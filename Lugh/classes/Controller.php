<?php

class Controller
{
    
    public $post, $get, $session, $cookies, $files, $views, $headers, $body;
    public $method = "get", $user;
    
    function __construct(){
        $this->get = Request::get();
        $this->post = Request::post();
        $this->files = Request::files();
        $this->body = Request::body();
        $this->headers = Request::headers();
        $this->session = new Session();
//        $this->cookies = new Cookies();
        
        
        
    }
    
    protected function Preenchido($obrigatorios, $data){
        $faltando = array();
        
        foreach($obrigatorios as $k => $v){
            if(!isset($data->$k) || empty($data->$k))
                $faltando[] = $v;
        }

        $resposta = (count($faltando) == 1) ? "O parâmetro " : "Os parâmetros ";

        for($i = 0; $i < count($faltando); $i++ ){
            $resposta .= "\"{$faltando[$i]}\"";

            if($i + 1 == count($faltando) - 1)
                $resposta .= " e ";
            elseif($i + 1 < count($faltando) - 1)
                $resposta .= ", ";
            else
                $resposta .= " ";
        }   

        $resposta .= (count($faltando) == 1) ? "precisa ser informado!" : "precisam ser informados!";
        
        return (count($faltando) == 0) ? true : $resposta;
    }
    
    protected function VerificaSessao(){
        $status = null;
        $token = "";
        
        $verifica_sessao = function($token){
            $sess = DB::construct("sessao");
            $sess->where("token = '{$token}'");
            $session = $sess->get();
            
            if($session){
            
                if($session->ultima_data >= strtotime("-5 hours")){
                    $sess->ultima_data = time();
                    $this->user = $session->usuario;
                    $sess->update();
                    return true;
                }
                $sess->delete();
            }
            
            return null;
        };
        
        if(isset($this->session->token)){
            $token = $this->session->token;
        }else{
            if(isset($this->headers->Authorization)){
                $token = $this->headers->Authorization;
            }else{
                $json_str = file_get_contents('php://input');
                $json_obj = json_decode($json_str);
                $data = (empty($json_obj)) ? $this->{$this->method} : $json_obj;

                $token = $data->authorization;
            }
        }
        
        
        if($verifica_sessao($token))
            $status = $this->user;
        
        return $status;
    }
    
}