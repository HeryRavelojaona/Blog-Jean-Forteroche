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
    }
}