<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\HoursException;

class HoursExceptionController extends ApiGuardController {

	protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'index_category' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(HoursException::all()->toArray());
	}

	/**
     * Display a list of the resource with given category id.
     *
     * @return Response
     */
	public function index_category($category_id)
	{
		if(!HoursException::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }

        return Response::json(HoursException::whereCategoryId($category_id)->toArray());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

		$category_id = 0;
		if(Request::has('category_id')) {
			$category_id = Request::input('category_id');
		} else {
			$category_id = $user->category()->id;
		}

		$date = date('Y-m-d', strtotime(Request::input('date')));
		if(Hour::whereCategoryId($category_id)->whereDate($date)->exists()) {
			return Response::json([
				'code' => 400
				'message' => 'A category can only have one entry per date in the Hours Exception table.'
			], 400);
		}

		$hours_exception = new HoursException;
		$hours_exception->date = $date;
		$hours_exception->open = date('h:i A', strtotime(Request::input('open')));
		$hours_exception->close = date('h:i A', strtotime(Request::input('close')));
		$hours_exception->category_id = $category_id;

		if(!$hours_exception->save()) {
			return Response::json([
				'code' => 500,
				'message' => 'Hours exception was not created due to an internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Hours exception created successfully.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$hours_exception = HoursException::find($id);

		if($hours_exception == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Hours exception not found.'
			], 400);
		}

		return Response::json($hours_exception->toArray());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$hours_exception = HoursException::find($id);

		if($hours_exception == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Hours exception not found.'
			], 400);
		}

		$user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

		$category_id = 0;
		if(Request::has('category_id')) {
			$category_id = Request::input('category_id');
		} else {
			$category_id = $user->category()->id;
		}

		$date = date('Y-m-d', strtotime(Request::input('date')));
		if(Hour::whereCategoryId($category_id)->whereDate($date)->exists()) {
			return Response::json([
				'code' => 400
				'message' => 'A category can only have one entry per date in the Hours Exception table.'
			], 400);
		}

		$hours_exception->date = $date;
		$hours_exception->open = date('h:i A', strtotime(Request::input('open')));
		$hours_exception->close = date('h:i A', strtotime(Request::input('close')));
		$hours_exception->category_id = $category_id;

		if(!$hours_exception->save()) {
			return Response::json([
				'code' => 500,
				'message' => 'Hours exception was not updated due to an internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Hours exception updated successfully.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$hours_exception = HoursException::find($id);

		if($hours_exception == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Hours exception not found.'
			], 400);
		}

		if(!$hours_exception->delete()) {
			return Response::json([
				'code' => 500,
				'message' => 'Hours exception was not deleted due to an internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Hours exception deleted successfully.']);
	}

}
