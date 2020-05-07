<?php

namespace Blog\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if($name === 'Register') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
        elseif($name === 'updatePassword') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
        elseif($name === 'Article') {
            $articleValidation = new ArticleValidation();
            $errors = $articleValidation->check($data);
            return $errors;
        }
    }
}