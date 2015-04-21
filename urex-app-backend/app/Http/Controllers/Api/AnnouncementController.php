<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Announcement;

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

        return Response::json(Announcement::whereCategoryId($category_id)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $announcement = new Announcement;
        $announcement->message = Request::input('message');
        $announcement->date = date("Y-m-d h:i A", strtotime(Request::input('date')));
        $announcement->user_id = $user->id;

        if(Request::has('category_id')) {
            $announcement->category_id = Request::input('category_id');
        } else {
            $announcement->category_id = $user->category()->id;
        }

        if(!$announcement->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Announcement was not created due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Announcement created succesffully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $announcement = Announcement::find($id);

        if($announcement == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Announcement not found.'
            ], 400);
        }

        return Response::json($announcement->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $announcement = Announcement::find($id);

        if($announcement == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Announcement not found.'
            ], 400);
        }

        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $announcement->message = Request::input('message');
        $announcement->date = date("Y-m-d h:i A", strtotime(Request::input('date')));
        $announcement->user_id = $user->id;

        if(Request::has('category_id')) {
            $announcement->category_id = Request::input('category_id');
        } else {
            $announcement->category_id = $user->category()->id;
        }

        if(!$announcement->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Announcement was not updated due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Announcement updated succesffully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if($announcement == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Announcement not found.'
            ], 400);
        }

        if(!$announcement->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Announcement was not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Announcement deleted successfully.']);
    }

}
