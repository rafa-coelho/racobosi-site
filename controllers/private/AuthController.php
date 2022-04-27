<?php

class AuthController extends Controller
{

    public function Criar()
    {
        if(!isset($this->post->token)){
            http_response_code(400);
            print("O token é obrigatório");
            return;
        }

        $token = $this->post->token;

        $db = new DB("tokens");
        $db->where("token = '$token'");

        if($db->get() != false){
            http_response_code(400);
            print("Essa conta já foi cadastrada");
            return;
        }

        $db->token = $token;
        $db->insert();
        http_response_code(200);
        return;
    }

    public function Autenticar()
    {
        if(!isset($this->post->token)){
            http_response_code(400);
            print("O token é obrigatório");
            return;
        }

        $token = $this->post->token;

        $db = new DB("tokens");
        $db->where("token = '$token'");

        $registro = $db->get();
        if($registro == false){
            http_response_code(404);
            print("Conta não encontrada");
            return;
        }

        print($registro->token);
        return;
    }

}
