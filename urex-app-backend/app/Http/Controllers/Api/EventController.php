<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Event;

class EventController extends ApiGuardController {

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ]

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Event::all()->toArray());
    }

    /**
     * Display a list of the resource with given category id.
     *
     * @param int  $category_id
     * @return Response
     */
    public function index_category($category_id) 
    {
        return Response::json(Event::whereCategoryId($category_id)->toArray())
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $event = new Event;
        $event->title = Request::input('title');
        $event->description = Request::input('description');
        $event->start = date("Y-m-d H:i:s", strtotime(Request::input('start')));
        $event->end = date("Y-m-d H:i:s", strtotime(Request::input('end')));
        $event->cost = Request::input('cost');
        $event->spots = Request::input('spots');
        $event->user_id = $user->id;

        if(Request::has('category_id')) {
            $event->category_id = Request::input('category_id');
        } else {
            $event->category_id = $user->category()->id;
        }

        if(!$event->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Event was not created due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Event created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        if(isNull($event)) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        return Response::json($event->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $event = Event::find($id);

        if(isNull($event)) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $event->title = Request::input('title');
        $event->description = Request::input('description');
        $event->start = date("Y-m-d H:i:s", strtotime(Request::input('start')));
        $event->end = date("Y-m-d H:i:s", strtotime(Request::input('end')));
        $event->cost = Request::input('cost');
        $event->spots = Request::input('spots');
        $event->user_id = $user->id;

        if(Request::has('category_id')) {
            $event->category_id = Request::input('category_id');
        } else {
            $event->category_id = $user->category()->id;
        }

        if(!$event->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Event was not updated due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Event updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if(isNull($event)) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        if(!$event->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Event was not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Event deleted succesfully.']);
    }

}
