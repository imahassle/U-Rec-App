<?php namespace App\Exceptions;

class AuthException extends UrexException 
{
    
    public function __construct($message)
    {
        parent::__construct($message, 401);
    }

}