<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Category;
use Response;

class AdminCheck implements Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null($request->header('X-Authorization'))) {
            return Response::json([
                'code' => 403,
                'message' => 'No valid API key found.'
            ], 403);
        }

        $user = ApiKey::whereKey($request->header('X-Authorization'))->first()->user;

        if($user->category_id != Category::whereName('Administration')->first()->id) {
            return \Response::json([
                'code' => 403,
                'message' => "You aren't supposed to access this functionality..."
            ], 403);
        }

        return $next($request);
    }

}
