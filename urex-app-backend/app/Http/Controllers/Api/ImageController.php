<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Image;

class ImageController extends ApiGuardController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Image::all()->toArray());
	}

	/**
     * Display a list of the resource with given category id.
     *
     * @return Response
     */
	public function index_category($category_id)
	{
		if(!Image::whereCategoryId($category_id)->exists()) {
            return Response::json([]);
        }
		
		return Response::json(Image::whereCategoryId($category_id)->toArray());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

		if(!Request::file('image')->isValid()) {
			return Response::json([
				'code' => 400,
				'message' => 'Supplied image file is invalid.'
			], 400);
		}

		$image = new Image;
		$image->file_location = '';
		$image->caption = Request::input('caption');

		if(Request::has('category_id')) {
            $image->category_id = Request::input('category_id');
        } else {
            $image->category_id = $user->category()->id;
        }

        if(!$image->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Image was not created due to an internal server error.'
            ], 500);
        }

        $image->file_location = 'image_'
        					  . strval($image->id)
        					  . '.' . Request::file('image')->getClientOriginalExtension();

        if(!Request::file('image')->move(Config::get('app.image_directory'), $image->file_location)) {
        	$image->delete();
        	return Response::json([
        		'code' => 400,
        		'message' => 'Image upload was not successful due to an internal server error.'
        	], 500);
        }

        if(!$image->save()) {
        	return Response::json([
        		'code' => 500,
        		'message' => 'Image was uploaded, but model was not successfully saved due to an internal server error.'
        	], 500);
        }

        return Response::json(['message' => 'Image created successfully.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$image = Image::find($id);

		if($image == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Image not found.'
			], 400);
		}

		return Response::json($image->toArray());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$image = Image::find($id);

		if($image == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Image not found.'
			], 400);
		}

		$file_location = Config::get('app.image_directory') . $image->file_location;
		File::delete($file_location);
		if(File::exists($file_location) || !$image->delete()) {
			return Response::json([
				'code' => 500,
				'message' => 'Image not deleted due to internal server error.'
			], 500);
		}

		return Response::json(['message' => 'Image deleted successfully.']);
	}

}
