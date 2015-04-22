<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Announcement;
use App\Exceptions\UrexException;

class AnnouncementController extends ApiGuardController {

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Announcement::all()->toArray());
    }

    /**
     * Display a list of the resource with given category id.
     *
     * @return Response
     */
    public function index_category($category_id)
    {
        if(!Announcement::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(Announcement::whereCategoryId($category_id)->get()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            Announcement::create($attributes);
            return Response::json(['message' => 'Announcement created succesffully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return Response::json(Announcement::find($id)->toArray());
        } catch (UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try {
            $attributes = Request::all() + ['X-Authorization' => Request::header('X-Authorization')];
            Announcement::find($id)->update($attributes);
            return Response::json(['message' => 'Announcement updated succesfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Announcement::find($id)->delete();
            return Response::json(['message' => 'Announcement deleted succesfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

}
