<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Image;
use App\Traits\UrexExecutionHandlerTrait;

class ImageController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(Image::all()->toArray());
    }

    public function index_category($category_id)
    {
        if(!Image::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
        return Response::json(Image::whereCategoryId($category_id)->get()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            return Response::json(Image::create($attributes)->toArray());
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(Image::find($id)->toArray());
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            Image::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}