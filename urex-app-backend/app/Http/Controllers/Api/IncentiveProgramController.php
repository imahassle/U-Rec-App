<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\IncentiveProgram;

class IncentiveProgramController extends ApiGuardController {

	protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(IncentiveProgram::all()->toArray());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

		$incentive_program = new IncentiveProgram;
		$incentive_program->title = Request::input('title');
		$incentive_program->description = Request::input('description');
		$incentive_program->user_id = $user->id;

		if(!$incentive_program->save()) {
			return Response::json([
				'code' => 500,
				'message' => 'Incentive program was not created due to an internal error'
			], 500);
		}

		return Response::json(['message' => 'Incentive program created successfully.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$incentive_program = IncentiveProgram::find($id);

		if($incentive_program == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Incentive program not found.'
			], 400);
		}

		return Response::json($incentive_program->toArray());
	}

    /**
     * Display the specified resource's images.
     *
     * @param  int  $id
     * @return Response
     */
    public function show_images($id)
    {
        $incentive_program = IncentiveProgram::find($id);

        if($incentive_program == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Incentive program not found.'
            ], 400);
        }

        return Response::json($incentive_program->images()->toArray());
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$incentive_program = IncentiveProgram::find($id);

		if($incentive_program == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Incentive program not found.'
			], 400);
		}

		$user = ApiKey::whereKey(Request::header('X-Authorization'))->user;

		$incentive_program->title = Request::input('title');
		$incentive_program->description = Request::input('description');
		$incentive_program->user_id = $user->id;

		if(!$incentive_program->save()) {
			return Response::json([
				'code' => 500,
				'message' => 'Incentive program was not updated due to an internal error'
			], 500);
		}

		return Response::json(['message' => 'Incentive program updated successfully.']);
	}

	/**
     * Associate an image with the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function add_image($id, $image_id)
    {
        if(ImageIncentiveProgram::whereIncentiveProgramId($id)->whereImageId($image_id)->exists()) {
            return Response::json([
                'code' => 400
                'message' => 'Image already associated with incentive program.'
            ], 400);
        }

        if(!IncentiveProgram::find($id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'Incentive program not found.'
            ], 400);
        }

        if(!Image::find($image_id)->exists()) {
            return Response::json([
                'code' => 400,
                'message' => 'Image not found.'
            ], 400);
        }

        $image_incentive_program = new ImageIncentiveProgram;
        $image_incentive_program->incentive_program_id = $id;
        $image_incentive_program->image_id = $image_id;

        if(!$image_incentive_program->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Image was not associated with incentive program due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Image associated successfully.']);
    }

    /**
     * Dissociate an image with the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete_image($id, $image_id)
    {
        $image_incentive_program = ImageIncentiveProgram::whereIncentiveProgramId($id)->whereImageId($image_id);

        if($image_incentive_program == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Image association not found.'
            ], 400);
        }

        if(!$image_incentive_program->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Image association was not deleted due to an internal server error.'
            ]);
        }

        return Response::json(['message' => 'Image association deleted succesfully.']);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$incentive_program = IncentiveProgram::find($id);

		if($incentive_program == null) {
			return Response::json([
				'code' => 400,
				'message' => 'Incentive program not found.'
			], 400);
		}

		if(!$incentive_program->delete()) {
			return Response::json([
				'code' => 500,
				'message' => 'Incentive program was not deleted due to an internal server error.'
			], 500);
		}

		$image_associations = ImageIncentiveProgram::whereIncentiveProgramId($id);

		 if($image_associations != null && !$image_associations->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Incentive program deleted, but image associations not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Incentive program deleted succesfully.']);
	}

}
