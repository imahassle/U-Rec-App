<?php namespace App\Exceptions;

class AdminException extends UrexException 
{
    
    public function __construct($message)
    {
        parent::__construct($message, 403);
    }

}