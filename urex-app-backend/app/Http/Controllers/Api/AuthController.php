<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        return Response::json(array_merge($user->toArray(), [ Category::find($user->category_id)->name ])
            ->withCookie(cookie('U-Rex-API-Key', $user->apiKey->key, 10080)));
    }

    public function logout()
    {
        return Response::make('')->withCookie(Cookie::forget('U-Rex-API-Key'));
    }

    /*
        Download and use this script to get $.cookie(): https://github.com/carhartl/jquery-cookie.
        All AJAX Calls will need to define a headers object with 'X-Authorization' set to the API key:
            Example:
                $.ajax({
                    url: 'foo/bar',
                    headers: { 'X-Authorization', $.cookie('U-Rex-API-Key') }
                    ...
                });
    */
}
