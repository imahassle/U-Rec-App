<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use Hash;
use Response;

use Illuminate\Support\Facades\Request;

class AuthController extends Controller {

    public function login()
    {
        $username = Request::input('username');
        $password = Request::input('password');

        $user = User::whereUsername($username)->first();
        if($user == null || !Hash::check($password, $user->password)) {
            return Response::json(['code' => 401, 'message' => 'Invalid credentials.'], 401);
        }

        return Response::json(array_merge($user->toArray(), [ 'api_key' => $user->apiKey->key ]));
    }
    
}
