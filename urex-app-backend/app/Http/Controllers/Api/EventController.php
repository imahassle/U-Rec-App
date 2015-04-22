<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Event;

class EventController extends ApiGuardController {

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ],
        'show_images' => [ 'keyAuthentication' => false ]
    ];

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
     * @return Response
     */
    public function index_category($category_id) 
    {
        if(!Event::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(Event::whereCategoryId($category_id)->toArray());
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
        $event->start = date("Y-m-d h:i A", strtotime(Request::input('start')));
        $event->end = date("Y-m-d h:i A", strtotime(Request::input('end')));
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

        if($event == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        return Response::json($event->toArray());
    }

    /**
     * Display the specified resource's images.
     *
     * @param  int  $id
     * @return Response
     */
    public function show_images($id)
    {
        $event = Event::find($id);

        if($event == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        return Response::json($event->images()->toArray());
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

        if($event == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $event->title = Request::input('title');
        $event->description = Request::input('description');
        $event->start = date("Y-m-d h:i A", strtotime(Request::input('start')));
        $event->end = date("Y-m-d h:i A", strtotime(Request::input('end')));
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
     * Associate an image with the specified resource.
     *
     * @param  int  $id, int  $image_id
     * @return Response
     */
    public function add_image($id, $image_id)
    {
        if(EventImage::whereEventId($id)->whereImageId($image_id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'Image already associated with event.'
            ], 400);
        }

        if(!Event::find($id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'Event not found.'
            ], 400);
        }

        if(!Image::find($image_id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'Image not found.'
            ], 400);
        }

        $event_image = new EventImage;
        $event_image->event_id = $id;
        $event_image->image_id = $image_id;

        if(!$event_image->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Image was not associated with event due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Image associated successfully.']);
    }

    /**
     * Dissociate an image with the specified resource.
     *
     * @param  int  $id, int  $image_id
     * @return Response
     */
    public function delete_image($id, $image_id)
    {
        $event_image = EventImage::whereEventId($id)->whereImageId($image_id);

        if($event_image == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Image association not found.'
            ], 400);
        }

        if(!$event_image->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Image association was not deleted due to an internal server error.'
            ]);
        }

        return Response::json(['message' => 'Image association deleted succesfully.']);
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

        if($event == null) {
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

        $image_associations = EventImage::whereEventId($id);

        if($image_associations != null && !$image_associations->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Event deleted, but image associations not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Event deleted succesfully.']);
    }

}
