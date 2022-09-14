<?php

class Mail
{
    public $email, $nome, $assunto, $mensagem, $anexo, $alias;
    
    public function __construct(){
        Lugh::loadExtension('PHPMailer');
        $this->mail = new PHPMailer();
    }
    
    public function Enviar(){
        $status = false;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->mail->IsSMTP();
            $this->mail->Host = MAIL_HOST;
            $this->mail->SMTPAuth   = true;
            $this->mail->SMTPSecure = "TLS";
            $this->mail->Port       = MAIL_PORT;
            $this->mail->Username = MAIL_USERNAME;
            $this->mail->Password = MAIL_PASSWORD;
            $this->mail->CharSet = "UTF-8";
            $this->mail->SetFrom(MAIL_FROM, isset($this->alias) && !empty($this->alias) ? $this->alias : MAIL_ALIAS);
            $this->mail->AddReplyTo(MAIL_FROM, isset($this->alias) && !empty($this->alias) ? $this->alias : MAIL_ALIAS);

            $this->mail->AddAddress($this->email, $this->nome);
            
            $this->mail->Subject = $this->assunto;
            $this->mail->MsgHTML($this->mensagem);
            
            if(!is_null($this->anexo))
                $this->mail->AddAttachment($this->anexo->tmp_name, $this->anexo->name);

            if($this->mail->Send())
                $status = true;
        }
        
        return $status;
    }

    public function AddStringAttachment(string $string, string $filename, string $encoding = 'base64', string $type = 'image/png') {
        $this->mail->AddStringAttachment(base64_decode($string), $filename, $encoding, $type);
    }
}