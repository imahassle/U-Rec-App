<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\User;
use App\Traits\UrexControllerExecutionHandler;

class UserController extends ApiGuardController {

    use UrexControllerExecutionHandler;

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
        return $this->attemptExecution(function() {
            User::create(Request::all());
            return Response::json(['message' => 'User created succesfully.']);
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(User::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            User::find($id)->update(Request::all());
            return Response::json(['message' => 'User updated succesfully.']);
        });
    }

    public function update_password($id)
    {
        return $this->attemptExecution(function() use ($id) {
            User::find($id)->update_password(Request::all());
            return Response::json(['message' => 'User password updated successfully.']);
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            User::find($id)->delete();
            return Response::json(['message' => 'User deleted succesfully.']);
        });
    }
}
