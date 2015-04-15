<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\User;

class UserController extends ApiGuardController {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(User::all()->toArray());
    }

    /**
     * Display a list of the resource with given category id.
     *
     * @return Response
     */
    public function index_category($category_id)
    {
        if(!User::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(User::whereCategoryId($category_id)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User;
        $user->username = Request::input('username');
        $user->password = Hash::make(Request::input('password'));
        $user->first_name = Request::input('first_name');
        $user->last_name = Request::input('last_name');
        $user->email = Request::input('email');
        $user->category_id = Request::input('category_id');

        if(!$user->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'User was not created due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'User created succesfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if($user == null) {
            return Response::json([
                'code' => 400,
                'message' => 'User not found.'
            ], 400);
        }

        return Response::json($user->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);

        if($user == null) {
            return Response::json([
                'code' => 400,
                'message' => 'User not found.'
            ], 400);
        }

        $user->username = Request::input('username');
        $user->password = Hash::make(Request::input('password'));
        $user->first_name = Request::input('first_name');
        $user->last_name = Request::input('last_name');
        $user->email = Request::input('email');
        $user->category_id = Category::whereName(Request::input('category'));

        if(!$user->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'User was not updated due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'User updated succesfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user == null) {
            return Response::json([
                'code' => 400,
                'message' => 'User not found.'
            ], 400);
        }
        
        if(!$user->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'User was not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'User deleted succesfully.']);
    }
}
