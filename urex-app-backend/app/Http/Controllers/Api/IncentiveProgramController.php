<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\IncentiveProgram;
use App\Traits\UrexExecutionHandlerTrait;

class IncentiveProgramController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(IncentiveProgram::all()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(IncentiveProgram::create($attributes)->toArray());
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(IncentiveProgram::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(IncentiveProgram::find($id)->update($attributes)->toArray());
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            IncentiveProgram::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}
