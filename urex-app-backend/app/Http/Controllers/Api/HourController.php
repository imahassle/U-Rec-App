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
        'index_category_week' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(Hour::orderBy('day_of_week')->get()->toArray());
    }

    public function index_category($category_id)
    {
        if(!Hour::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
        return Response::json(Hour::whereCategoryId($category_id)->orderBy('day_of_week')->get()->toArray());
    }

    public function index_category_week($category_id)
    {
        if(!Hour::whereCategoryId($category_id)->exists())  {
            return Response::json([]);
        }
        return $this->attemptExecution(function() use ($category_id) {
            return Response::json(Hour::getNextWeek(Request::input('day'), $category_id));
        });
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(Hour::create($attributes)->toArray());
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
            return Response::json(Hour::find($id)->update($attributes)->toArray());
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            Hour::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}
