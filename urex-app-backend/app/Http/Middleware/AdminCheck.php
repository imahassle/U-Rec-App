<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Category;
use Response;
use Illuminate\Http\Request;
use App\Traits\UrexExecutionHandlerTrait;
use App\Exceptions\AdminException;
use App\User;

class AdminCheck implements Middleware {

    use UrexExecutionHandlerTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $this->attemptExecution(function() use ($request) {
            if(is_null($request->header('X-Authorization'))) {
                throw new AuthException("No valid API key found.");
            }
            $user = User::find(ApiKey::whereKey($request->header('X-Authorization'))->first()->user_id);
            if($user->category_id != Category::whereName('Administration')->first()->id) {
                throw new AdminException("You aren't supposed to access this functionality...");
            }
            return null;
        });

        if(!is_null($response)) {
            return $response;
        }

        return $next($request);
    }

}
