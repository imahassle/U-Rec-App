<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\User;
use App\Exceptions\UrexException;

class UserController extends ApiGuardController {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index()
    {
        return Response::json(User::all()->toArray());
    }

    public function index_category($category_id)
    {
        if(!User::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(User::whereCategoryId($category_id)->get()->toArray());
    }

    public function store()
    {
        try {
            User::create(Request::all());
            return Response::json(['message' => 'User created succesfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    public function show($id)
    {
        try {
            return Response::json(User::find($id)->toArray());
        } catch (UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    public function update($id)
    {
        try {
            User::find($id)->update(Request::all());
            return Response::json(['message' => 'User updated succesfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    public function update_password($id)
    {
        try {
            User::find($id)->update_password(Request::all());
            return Response::json(['message' => 'User password updated successfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return Response::json(['message' => 'User deleted succesfully.']);
        } catch(UrexException $e) {
            return Response::json([
                'code' => $e->code(),
                'message' => $e->getMessage()
            ], $e->code());
        }
    }
}
