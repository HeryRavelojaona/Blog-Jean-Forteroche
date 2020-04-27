<?php

namespace Blog\src\model;

class Mailing
{

    
    public function validateAccount($mail, $token, $pseudo)
    {
        $this->mail = $mail;
        $this->token = $token;
        $this->pseudo = $pseudo;

        $header = "MIME-Version: 1.0\r\n";
        $header = 'From: "Blog de Jean Forteroche'."\n";
        $header = 'Content-type:text/html;charset="utf-8"'."\n";
        $headers = 'Content-Transfer-Encoding: 8bit';
        $subject = 'Validation de votre compte sur le blog JeanForteroche';
        $content = '
        <html>
            <body>
                <h1 style="text-align:center;"> Cliquez sur le bouton pour finir l\'inscription</h1>
                <form style="text-align:center;" method="post" action="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=validateAccount">
                    <input type="hidden" name"token" value="'.$this->token .'">
                    <input type="hidden" name"token" value="'.$this->pseudo.'">
                    <input type="submit" name="submit" style="background-color:red; color:#fff;" value="valider">
                </form>
            </body>
        </html>';
        mail($this->mail, $subject, $content, $header);
    }
}