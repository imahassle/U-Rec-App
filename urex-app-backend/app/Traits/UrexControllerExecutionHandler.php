<?php namespace App\Traits;

use App\Exceptions\UrexException;
use Response;

trait UrexControllerExecutionHandler
{

    private function attemptExecution(callable $func)
    {
        try {
            return $func();
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

}