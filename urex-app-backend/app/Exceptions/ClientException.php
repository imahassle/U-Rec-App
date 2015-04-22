<?php namespace App\Exceptions;

class ClientException extends UrexException 
{
    
    public function __construct($message)
    {
        parent::__construct($message, 400);
    }

}