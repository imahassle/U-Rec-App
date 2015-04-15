<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\ItemRental;

class ItemRentalController extends ApiGuardController {

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
        return Response::json(ItemRental::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $item_rental = new ItemRental;
        $item_rental->name = Request::input('name');
        $item_rental->faculty_pricing_1 = Request::input('faculty_pricing_1');
        $item_rental->faculty_pricing_2 = Request::input('faculty_pricing_2');
        $item_rental->faculty_pricing_3 = Request::input('faculty_pricing_3');
        $item_rental->faculty_pricing_4 = Request::input('faculty_pricing_4');
        $item_rental->student_pricing_1 = Request::input('student_pricing_1');
        $item_rental->student_pricing_2 = Request::input('student_pricing_2');
        $item_rental->student_pricing_3 = Request::input('student_pricing_3');
        $item_rental->student_pricing_4 = Request::input('student_pricing_4');

        if(!$item_rental->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Item rental was not created due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Item rental created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item_rental = ItemRental::find($id);

        if($item_rental == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Item rental not found.'
            ], 400);
        }

        return Response::json($item_rental->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $item_rental = ItemRental::find($id);

        if($item_rental == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Item rental not found.'
            ], 400);
        }

        $item_rental->name = Request::input('name');
        $item_rental->faculty_pricing_1 = Request::input('faculty_pricing_1');
        $item_rental->faculty_pricing_2 = Request::input('faculty_pricing_2');
        $item_rental->faculty_pricing_3 = Request::input('faculty_pricing_3');
        $item_rental->faculty_pricing_4 = Request::input('faculty_pricing_4');
        $item_rental->student_pricing_1 = Request::input('student_pricing_1');
        $item_rental->student_pricing_2 = Request::input('student_pricing_2');
        $item_rental->student_pricing_3 = Request::input('student_pricing_3');
        $item_rental->student_pricing_4 = Request::input('student_pricing_4');

        if(!$item_rental->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Item rental was not updated due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Item rental updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item_rental = ItemRental::find($id);

        if($item_rental == null) {
            return Response::json([
                'code' => 400,
                'message' => 'Item rental not found.'
            ], 400);
        }

        if(!$item_rental->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Item rental was not deleted due to an internal server error.'
            ]);
        }

        return Response::json(['message' => 'Item rental deleted successfully.']);
    }

}
