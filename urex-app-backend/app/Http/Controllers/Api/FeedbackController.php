<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feedback;

class FeedbackController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::header('X-Authorization') != null) {
			return Response::json([
				'code' => 403,
				'message' => 'Authorized users are not allowed to submit feedback.'
			], 403);
		}

		$feedback = new Feedback;
		$feedback->message = Request::input('feedback');
		$feedback->email = Request::input('email');
		$feedback->date = date('Y-m-d h:i A', strtotime(Request::input('date')));

		if(!$feedback->save()) {
			return Response::json([
				'code' => 500,
				'message' => 'Feedback was not created due to an internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Feedback created successfully.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Request::header('X-Authorization') == null) {
			return Response::json([
				'code' => 403,
				'message' => 'Non-authorized users are not allowed to see feedback.'
			], 403);
		}

		$feedback = Feedback::find($id);

		if($feedback == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Feedback not found.'
			], 400);
		}

		return Response::json($feedback->toArray());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::header('X-Authorization') == null) {
			return Response::json([
				'code' => 403,
				'message' => 'Non-authorized users are not allowed to delete feedback.'
			], 403);
		}

		$feedback = Feedback::find($id);

		if($feedback == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Feedback not found.'
			], 400);
		}

		if(!$feedback->delete()) {
			return Response::json([
				'code' => 500,
				'message' => 'Feedback was not deleted due to an internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Feedback deleted successfully.']);
	}

}
