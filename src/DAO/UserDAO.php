<?php

namespace Blog\src\DAO;

use Blog\config\Parameter;


class UserDAO extends DAO
{
    public function register(Parameter $post, $token)
    {  
        $token;
        $role = 'none';
        $sql = 'INSERT INTO user (pseudo, password, mail, token, role, status) VALUES (:pseudo, :password, :mail, :token, :role, :status)';
        $this->createQuery($sql, 
        ['pseudo'=>$post->get('pseudo'),
         'password'=>password_hash($post->get('password'), PASSWORD_BCRYPT),
         'mail'=>$post->get('mail'),
         'token'=>$token,
         'role'=>$role,
         'status'=>0
         ]);
    } 

    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $isUnique = $result->fetchColumn();
        if($isUnique) {
            return '<p>Le pseudo existe déjà</p>';
        }  
    }

    public function checkMail(Parameter $post)
    {
        $sql = 'SELECT COUNT(mail) FROM user WHERE mail = ?';
        $result = $this->createQuery($sql, [$post->get('mail')]);
        $isUnique = $result->fetchColumn();
        if($isUnique) {
            return '<p>Votre mail est déja utiliser</p>';
        }  
    }

    public function validateAccount(Parameter $get)
    {
        $token = $get->get('token');
        $sql = "UPDATE user SET status = :status  WHERE token = :token";
        $this->createQuery($sql,
        [   'status'=>1,
            'token'=>$token
        ]);
      
    }

<<<<<<< HEAD
    //check if user is registered
    public function checkAccount(Parameter $get)
    {
        $sql = 'SELECT COUNT(status) FROM user WHERE token = ?';
        $result = $this->createQuery($sql, [$get->get('token')]);
        $isRegistered = $result->fetchColumn();
    
        return $isRegistered;
=======
    public function login(Parameter $post)
    {
        $sql = 'SELECT * FROM user WHERE mail = ?';
        $data = $this->createQuery($sql, [$post->get('mail')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

    public function updatePassword(Parameter $post, $mail)
    {
        $sql = 'UPDATE user SET password = :password WHERE mail = :mail';
        $this->createQuery($sql, [
            'password'=>password_hash($post->get('password'), PASSWORD_BCRYPT),
            'mail'=> $mail]);
    }

    public function checkMailToChangepass(Parameter $get)
    {
        $sql = 'SELECT COUNT(mail) FROM user WHERE mail = ?';
        $result = $this->createQuery($sql, [$get->get('mail')]);
        $isUnique = $result->fetchColumn();
        if($isUnique) {
            return $isUnique;
        }  
>>>>>>> userInterface
    }
}