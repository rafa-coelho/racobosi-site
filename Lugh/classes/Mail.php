<?php

class Mail
{
    public $email, $nome, $assunto, $mensagem, $anexo;
    
    public function __construct(){
        Lugh::loadExtension('phpmailer');
    }
    
    public function Enviar(){
        $status = false;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "TLS";
            $mail->Port       = MAIL_PORT;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SetFrom(MAIL_FROM, MAIL_ALIAS);
            $mail->AddReplyTo(MAIL_FROM, MAIL_ALIAS);

            $mail->AddAddress($this->email, $this->nome);
            
            $mail->Subject = $this->assunto;
            $mail->MsgHTML($this->mensagem);
            
            if(!is_null($this->anexo))
                $mail->AddAttachment($this->anexo->tmp_name, $this->anexo->name);

            if($mail->Send())
                $status = true;
             
        }
        
        return $status;
    }
}