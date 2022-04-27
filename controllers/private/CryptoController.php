<?php

include('Lugh/Crypt/Rijndael.php');
include('Lugh/Crypt/Random.php');

define("CYPHER_OPT", 0);
define("CYPHER_TYPE", "AES-128-CTR");

class CryptoController extends Controller
{
    public function Encrypt()
    {
        if (!isset($this->post->token)) {
            http_response_code(400);
            print("O token é obrigatório");
            return;
        }

        if (!isset($this->post->iv)) {
            http_response_code(400);
            print("O iv é obrigatório");
            return;
        }

        if (!isset($this->post->text)) {
            http_response_code(400);
            print("O text é obrigatório");
            return;
        }
        
        $cipher = new Crypt_Rijndael();
        $cipher->setKey($this->post->token);
        $cipher->setIV($this->post->iv);

        print_r(base64_encode($cipher->encrypt($this->post->text)));
    }

    public function Decrypt()
    {
        if (!isset($this->post->token)) {
            http_response_code(400);
            print("O token é obrigatório");
            return;
        }

        if (!isset($this->post->iv)) {
            http_response_code(400);
            print("O iv é obrigatório");
            return;
        }

        if (!isset($this->post->text)) {
            http_response_code(400);
            print("O text é obrigatório");
            return;
        }
        
        $cipher = new Crypt_Rijndael();
        $cipher->setKey($this->post->token);
        $cipher->setIV($this->post->iv);
        
        print_r($cipher->decrypt(base64_decode($this->post->text)));
    }
}
