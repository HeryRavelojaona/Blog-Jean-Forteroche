<?php

namespace Blog\config;

class Mailing
{
    protected $headers;
    protected $mail;
    protected $pseudo;
  

    public function __construct()
    {   
        $this->headers = 'MIME-Version: 1.0' . "\r\n";;
      
        $this->headers = 'From: "Jean Forteroche"'."\r\n";
        $this->headers = 'Content-Type:text/html; charset="iso-8859-1"'."\r\n";
        $this->headers = 'Content-Transfer-Encoding: 8bit'."\r\n";
    }
    public function validateAccount($mail, $token, $pseudo)
    {
        $this->mail = $mail;
        $this->token = $token;
        $this->pseudo = $pseudo;

        $subject = 'Validation de votre compte sur le blog JeanForteroche';
        $message = '
            <body style="text-align:center;">
                <h1 style="text-align:center;"> Cliquez sur le bouton pour finir l\'inscription</h1>
                <a href="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=validateAccount&token='.$this->token.'" style=" border: 1px solid; padding:5px; border-radius:10px;">Validation</a>
            </body>';
        mail($this->mail, $subject, $message, $this->headers);
    }

    public function forgotPassword($mail)
    {
        $this->mail = $mail;
        $subject = 'blog JeanForteroche';
        $message = '
            <body style="text-align:center;">
                <h1 style="text-align:center;"> Cliquez sur le bouton pour changer de mot de passe</h1>
                <a href="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=changepass&mail='.$this->mail.'" " style=" border: 1px solid; padding:5px; border-radius:10px;">Validation</a>
            </body>';
        mail($this->mail, $subject, $message, $this->headers);
    }
}