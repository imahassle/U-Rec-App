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
            IncentiveProgram::create($attributes);
            return Response::json(['message' => 'Program created succesffully.']);
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(IncentiveProgram::find($id)->toArray());
        });
    }

    public function show_images($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(IncentiveProgram::find($id)->images->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            IncentiveProgram::find($id)->update($attributes);
            return Response::json(['message' => 'Program updated successfully.']);
        });
    }

    public function associate_image($id, $image_id)
    {
        return $this->attemptExecution(function() use ($id, $image_id) {
            IncentiveProgram::find($id)->associate_image($image_id);
            return Response::json(['message' => 'Image associated with program successfully.']);
        });
    }

    public function dissociate_image($id, $image_id)
    {
        return $this->attemptExecution(function() use ($id, $image_id) {
            IncentiveProgram::find($id)->dissociate_image($image_id);
            return Response::json(['message' => 'Image dissociated with program successfully.']);
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            IncentiveProgram::find($id)->delete();
            return Response::json(['message' => 'Program deleted successfully.']);
        });
    }

}
