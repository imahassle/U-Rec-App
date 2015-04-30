<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Feedback;
use App\Traits\UrexExecutionHandlerTrait;

class FeedbackController extends Controller {

    use UrexExecutionHandlerTrait;

    public function index()
    {
        if(Request::header('X-Authorization') == null) {
            return Response::json([
                'error' => 'Non-authorized users are not allowed to see feedback.'
            ], 403);
        }

        return Response::json(Feedback::all()->toArray());
    }

    public function store()
    {
        if(Request::header('X-Authorization') != null) {
            return Response::json([
                'error' => 'Authorized users are not allowed to submit feedback.'
            ], 403);
        }

        return $this->attemptExecution(function() {
            return Response::json(Feedback::create(Request::all())->toArray());
        });
    }

    public function show($id)
    {
        if(Request::header('X-Authorization') == null) {
            return Response::json([
                'error' => 'Non-authorized users are not allowed to see feedback.'
            ], 403);
        }

        return $this->attemptExecution(function() use ($id) {
            return Response::json(Feedback::find($id)->toArray());
        });
    }

    public function destroy($id)
    {
        if(Request::header('X-Authorization') == null) {
            return Response::json([
                'error' => 'Non-authorized users are not allowed to delete feedback.'
            ], 403);
        }

        return $this->attemptExecution(function() use ($id) {
            Feedback::find($id)->delete();
            return Response::json(['success' => true]);
        });
    }

}