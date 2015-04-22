<?php namespace App\Exceptions;

class UrexException extends \Exception 
{
    protected $error_code;

    public function __construct($message, $code) 
    {
        parent::__construct($message);
        $this->error_code = $code;
    }

    public function code() {
        return $this->error_code;
    }

}