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
                'code' => 403,
                'message' => 'Non-authorized users are not allowed to see feedback.'
            ], 403);
        }

        return Response::json(Feedback::all()->toArray());
    }

    public function store()
    {
        if(Request::header('X-Authorization') != null) {
            return Response::json([
                'code' => 403,
                'message' => 'Authorized users are not allowed to submit feedback.'
            ], 403);
        }

        return $this->attemptExecution(function() {
            Feedback::create(Request::all());
            return Response::json(['message' => 'Feedback created successfully.']);
        });
    }

    public function show($id)
    {
        if(Request::header('X-Authorization') == null) {
            return Response::json([
                'code' => 403,
                'message' => 'Non-authorized users are not allowed to see feedback.'
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
                'code' => 403,
                'message' => 'Non-authorized users are not allowed to delete feedback.'
            ], 403);
        }

        return $this->attemptExecution(function() use ($id) {
            Feedback::find($id)->delete();
            return Response::json(['message' => 'Feedback deleted successfully.']);
        });
    }

}