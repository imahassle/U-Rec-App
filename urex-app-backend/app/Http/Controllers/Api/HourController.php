<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Hour;
use App\Traits\UrexExecutionHandlerTrait;

class HourController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(Hour::all()->toArray());
    }

    public function index_category($category_id)
    {
        if(!Hour::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
        return Response::json(Hour::whereCategoryId($category_id)->get()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            Hour::create($attributes);
            return Response::json(['message' => 'Hours created successfully.']);
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(Hour::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            Hour::find($id)->update($attributes);
            return Response::json(['message' => 'Hours updated successfully.']);
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            Hour::find($id)->delete();
            return Response::json(['message' => 'Hours deleted successfully.']);
        });
    }

}
