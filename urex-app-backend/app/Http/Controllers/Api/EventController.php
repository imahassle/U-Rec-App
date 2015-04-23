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
        'show' => [ 'keyAuthentication' => false ],
        'show_images' => [ 'keyAuthentication' => false ]
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
            Event::create($attributes);
            return Response::json(['message' => 'Event created succesffully.']);
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(Event::find($id)->toArray());
        });
    }

    public function show_images($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(Event::find($id)->images->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            Event::find($id)->update($attributes);
            return Response::json(['message' => 'Event updated successfully.']);
        });
    }

    public function associate_image($id, $image_id)
    {
        return $this->attemptExecution(function() use ($id, $image_id) {
            Event::find($id)->associate_image($image_id);
            return Response::json(['message' => 'Image associated with event successfully.']);
        });
    }

    public function dissociate_image($id, $image_id)
    {
        return $this->attemptExecution(function() use ($id, $image_id) {
            Event::find($id)->dissociate_image($image_id);
            return Response::json(['message' => 'Image dissociated with event successfully.']);
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            Event::find($id)->delete();
            return Response::json(['message' => 'Event deleted successfully.']);
        });
    }

}