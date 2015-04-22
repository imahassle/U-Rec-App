<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Hour;

class HourController extends ApiGuardController {

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
        return Response::json(Hour::all()->toArray());
    }

    /**
     * Display a list of the resource with given category id.
     *
     * @return Response
     */
    public function index_category($category_id)
    {
        if(!Hour::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(Hour::whereCategoryId($category_id)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $category_id = 0;
        if(Request::has('category_id')) {
            $category_id = Request::input('category_id');
        } else {
            $category_id = $user->category()->id;
        }

        if(Hour::whereCategoryId($category_id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'A category can only have one entry in the Hours table.'
            ], 400);
        }

        $hour = new Hour;
        $hour->mon_open = date("h:i A", strtotime(Request::input('mon_open')));
        $hour->mon_close = date("h:i A", strtotime(Request::input('mon_close')));
        $hour->tue_open = date("h:i A", strtotime(Request::input('tue_open')));
        $hour->tue_close = date("h:i A", strtotime(Request::input('tue_close')));
        $hour->wed_open = date("h:i A", strtotime(Request::input('wed_open')));
        $hour->wed_close = date("h:i A", strtotime(Request::input('wed_close')));
        $hour->thu_open = date("h:i A", strtotime(Request::input('thu_open')));
        $hour->thu_close = date("h:i A", strtotime(Request::input('thu_close')));
        $hour->fri_open = date("h:i A", strtotime(Request::input('fri_open')));
        $hour->fri_close = date("h:i A", strtotime(Request::input('fri_close')));
        $hour->sat_open = date("h:i A", strtotime(Request::input('sat_open')));
        $hour->sat_close = date("h:i A", strtotime(Request::input('sat_close')));
        $hour->sun_open = date("h:i A", strtotime(Request::input('sun_open')));
        $hour->sun_close = date("h:i A", strtotime(Request::input('sun_close')));
        $hour->category_id = $category_id;

        if(!$hour->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Hour was not created due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Hour created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $hour = Hour::find($id);

        if($hour == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Hour not found.'
            ], 400);
        }

        return Response::json($hour->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $hour = Hour::find($id);

        if($hour == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Hour not found.'
            ], 400);
        }

        $user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

        $category_id = 0;
        if(Request::has('category_id')) {
            $category_id = Request::input('category_id');
        } else {
            $category_id = $user->category()->id;
        }

        if(Hour::whereCategoryId($category_id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'A category can only have one entry in the Hours table.'
            ], 400);
        }

        $hour->mon_open = date("h:i A", strtotime(Request::input('mon_open')));
        $hour->mon_close = date("h:i A", strtotime(Request::input('mon_close')));
        $hour->tue_open = date("h:i A", strtotime(Request::input('tue_open')));
        $hour->tue_close = date("h:i A", strtotime(Request::input('tue_close')));
        $hour->wed_open = date("h:i A", strtotime(Request::input('wed_open')));
        $hour->wed_close = date("h:i A", strtotime(Request::input('wed_close')));
        $hour->thu_open = date("h:i A", strtotime(Request::input('thu_open')));
        $hour->thu_close = date("h:i A", strtotime(Request::input('thu_close')));
        $hour->fri_open = date("h:i A", strtotime(Request::input('fri_open')));
        $hour->fri_close = date("h:i A", strtotime(Request::input('fri_close')));
        $hour->sat_open = date("h:i A", strtotime(Request::input('sat_open')));
        $hour->sat_close = date("h:i A", strtotime(Request::input('sat_close')));
        $hour->sun_open = date("h:i A", strtotime(Request::input('sun_open')));
        $hour->sun_close = date("h:i A", strtotime(Request::input('sun_close')));
        $hour->category_id = $category_id;

        if(!$hour->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Hour was not updated due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Hour updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $hour = Hour::find($id);

        if($hour == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Hour not found.'
            ], 400);
        }

        if(!$hour->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Hour was not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Hour deleted successfully.']);
    }

}
