<?php

class MailerController extends Controller
{       
    public function EnviarEmail()
    {
        if(!isset($this->headers->token) || empty($this->headers->token)){
            http_response_code(400);
            print("O header \"token\" é obrigatório");
            return;
        }

        if($this->headers->token != RC_TOKEN)
        {
            http_response_code(401);
            print("O \"token\" é inválido");
            return;
        }
        
        $mandatoryFields = [ "address", "name", "subject", "body" ];
        foreach($mandatoryFields as $field)
        {
            if(!isset($this->body->$field) || empty($this->body->$field)){
                http_response_code(400);
                print("O campo \"" . $field . "\" é obrigatório");
                return;
            }
        }
        
        if (!filter_var($this->body->address, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            print("O campo \"address\" é precisa ser um email válido");
            return;
        }

        if(isset($this->body->attachments) && !is_array($this->body->attachments))
        {
            http_response_code(400);
            print("O campo \"attachments\" é precisa ser um array");
            return;
        }

        $mail = new Mail();
        $mail->email = $this->body->address;
        $mail->nome = $this->body->name;
        $mail->assunto = $this->body->subject;
        $mail->mensagem = $this->body->body;
        
        $attachments = $this->body->attachments;
        foreach($attachments as $a)
        {
            if(!((isset($a->filename) && !empty($a->filename)) && (isset($a->cid) && !empty($a->cid)) && (isset($a->content) && !empty($a->content))))
            {
                http_response_code(400);
                print("O campo \"attachments\" é precisa ser um array com os valores: \"filename\", \"cid\" e \"content\"");
                return;
            }
            $mail->AddStringAttachment($a->content, $a->filename);
        }
        
        if(isset($this->body->alias) && !empty($this->body->alias))
            $mail->alias = $this->body->alias;

        $mail->Enviar();
    } 
}