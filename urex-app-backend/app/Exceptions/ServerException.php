<?php namespace App\Exceptions;

class ServerException extends UrexException 
{
    
    public function __construct($message)
    {
        parent::__construct($message, 500);
    }

}