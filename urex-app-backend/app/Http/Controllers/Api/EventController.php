<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Event;
use App\Traits\UrexExecutionHandlerTrait;

class EventController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(Event::all()->toArray());
    }

    public function index_category($category_id) 
    {
        if(!Event::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
        return Response::json(Event::whereCategoryId($category_id)->get()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(Event::create($attributes)->toArray());
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(Event::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(Event::find($id)->update($attributes)->toArray());
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            Event::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}