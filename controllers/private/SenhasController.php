<?php

class SenhasController extends Controller
{    
    public function CriarSenha()
    {
        if(!isset($this->headers->token) || empty($this->headers->token)){
            http_response_code(400);
            print("O header \"token\" é obrigatório");
            return;
        }
        
        $tokenExists = Token::GetByToken($this->headers->token);
        if($tokenExists == null){
            http_response_code(400);
            print("Token não encontrado!");
            return;
        }

        if(!isset($this->post->nome) || empty($this->post->nome)){
            http_response_code(400);
            print("O nome é obrigatório");
            return;
        } 
        
        if(!isset($this->post->senha) || empty($this->post->senha)){
            http_response_code(400);
            print("A senha é obrigatória");
            return;
        }

        $db = new DB("senhas");
        $db->where("nome = '{$this->post->nome}' AND token = '{$tokenExists->id}'");
        
        if($db->get() != false){
            http_response_code(400);
            print("Já existe uma senha com esse nome");
            return;
        }       
        
        $db->nome = $this->post->nome;
        $db->senha = $this->post->senha;
        $db->token = $tokenExists->id;
        $db->insert();
        
        http_response_code(200);
        return;
    }

    public function BuscarSenha(){
        if(!isset($this->headers->token) || empty($this->headers->token)){
            http_response_code(400);
            print("O header \"token\" é obrigatório");
            return;
        }
        
        $tokenExists = Token::GetByToken($this->headers->token);
        if($tokenExists == null){
            http_response_code(400);
            print("Token não encontrado!");
            return;
        }

        $nome = isset($this->get->nome) ? $this->get->nome : "";
        $db = new DB("senhas");
        $db->where("nome = '$nome' AND token = '{$tokenExists->id}'");
        $registro = $db->get();

        if($registro == false){
            http_response_code(404);
            print("Senha não encontrada");
            return;
        }

        print($registro->senha);
    }

    public function AlterarSenha()
    {
        if(!isset($this->headers->token) || empty($this->headers->token)){
            http_response_code(400);
            print("O header \"token\" é obrigatório");
            return;
        }
        
        $tokenExists = Token::GetByToken($this->headers->token);
        if($tokenExists == null){
            http_response_code(400);
            print("Token não encontrado!");
            return;
        }

        if(!isset($this->put->nome)){
            http_response_code(400);
            print("O nome é obrigatório");
            return;
        } 
        
        if(!isset($this->put->senha)){
            http_response_code(404);
            print("A senha é obrigatória");
            return;
        }

        $nome = isset($this->put->nome) ? $this->put->nome : "";
        $senha = isset($this->put->senha) ? $this->put->senha : "";
        
        $db = new DB("senhas");
        $db->where("nome = '$nome' AND token = '{$tokenExists->id}'");
        
        if($db->get() == false){
            http_response_code(404);
            print("Senha não encontrada");
            return;
        }
        
        $db->senha = $senha;
        $db->update();
        
        http_response_code(204);
        return;
    }
}
