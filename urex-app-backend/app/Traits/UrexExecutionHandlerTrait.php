<?php namespace App\Traits;

use App\Exceptions\UrexException;
use Response;

trait UrexExecutionHandlerTrait
{

    private function attemptExecution(callable $func)
    {
        try {
            return $func();
        } catch(UrexException $e) {
            return Response::json([
                'error' => $e->getMessage()
            ], $e->code());
        }
    }

}