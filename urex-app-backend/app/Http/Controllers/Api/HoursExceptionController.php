<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\HoursException;
use App\Traits\UrexExecutionHandlerTrait;

class HoursExceptionController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(HoursException::orderBy('day')->get()->toArray());
    }

    public function index_category($category_id)
    {
        if(!HoursException::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
        return Response::json(HoursException::whereCategoryId($category_id)->orderBy('day')->get()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(HoursException::create($attributes)->toArray());
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(HoursException::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(HoursException::find($id)->update($attributes)->toArray());
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            HoursException::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}
