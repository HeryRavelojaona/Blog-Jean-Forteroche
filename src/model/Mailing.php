<?php

namespace Blog\src\model;

class Mailing
{
    protected $header;
    protected $mail;
    protected $pseudo;

    public function __construct()
    {   
        $this->header = "MIME-Version: 1.0\r\n";
        $this->header = 'From: "Blog de Jean Forteroche"'.'\n';
        $this->header = 'Content-type:text/html;charset="utf-8"'.'\n';
        $this->header = 'Content-Transfer-Encoding: 8bit';
    }
    public function validateAccount($mail, $token, $pseudo)
    {
        $this->mail = $mail;
        $this->token = $token;
        $this->pseudo = $pseudo;

        $subject = 'Validation de votre compte sur le blog JeanForteroche';
        $content = '
        <html>
            <body style="text-align:center;">
                <h1 style="text-align:center;"> Cliquez sur le bouton pour finir l\'inscription</h1>
                <a href="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=validateAccount&token='.$this->token.'" style=" border: 1px solid; padding:5px; border-radius:10px;">Validation</a>
            </body>
        </html>';
        mail($this->mail, $subject, $content, $this->header);
    }
}