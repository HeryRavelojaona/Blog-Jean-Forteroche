<?php

namespace Blog\config;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
class Mailing
{
    
    public function __construct()
    {   
        $https['ssl']['verify_peer'] = FALSE;
        $https['ssl']['verify_peer_name'] = FALSE;
        $this->transport = (new Swift_SmtpTransport(EMAIL_HOST, EMAIL_PORT))
        ->setUsername(EMAIL_USERNAME)
        ->setPassword(EMAIL_PASSWORD);
        //->setEncryption(EMAIL_ENCRYPTION) //For Gmail
        // Create the Mailer using your created Transport
        $this->mailer = new Swift_Mailer($this->transport);
        $this->fromEmail = 'contact@jeanforteroche.test';
        $this->fromUser = 'Jean Forteroche';

    }
    public function validateAccount($mail, $token)
    {
        $this->mail = $mail;
        $this->token = $token;
        
        $subject = 'Validation de votre compte sur le blog JeanForteroche';
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Mon premier mail</title>
                            </head>
                            <body style="text-align:center">
                                <h1>Cliquez sur le lien</h1>
                                <a href="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=validateAccount&token='.$this->token.'" style=" border: 1px solid; padding:5px; border-radius:10px;">Validation</a>
                            </body>
                        </html>';
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $this->fromUser])
         ->setTo([$this->mail])
        ->setBody($body, 'text/html');

        // Send the message
        $result = $this->mailer->send($message);
    }

    public function forgotPassword($mail)
    {
        $this->mail = $mail;
        $subject = 'Récuperer votre mot de passe';
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Changement de mot de passe</title>
                            </head>
                            <body style="text-align:center">
                                <h1>Cliquez sur le lien</h1>
                                <a href="http://jeanforteroche.heryravelojaona.fr/public/index.php?route=changepass&mail='.$this->mail.'" " style=" border: 1px solid; padding:5px; border-radius:10px;">Validation</a>
                            </body>
                        </html>';
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $this->fromUser])
         ->setTo([$this->mail])
        ->setBody($body, 'text/html');

        // Send the message
        $result = $this->mailer->send($message);
    }

    public function contact($post)
    {
        $mail = $post->get('mail');
        $pseudo = $post->get('pseudo');
        $content = $post->get('content');
        $subject = 'Message de votre site';
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Message</title>
                            </head>
                            <body style="text-align:center">
                                '.$content.'<br/>
                                '.$mail.' 
                            </body>
                        </html>';
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $pseudo])
         ->setTo([EMAIL_USERNAME])
        ->setBody($body, 'text/html');

        // Send the message
        $result = $this->mailer->send($message);
    }
}