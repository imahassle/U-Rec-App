<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;

class CategoryController extends ApiGuardController {

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Category::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:255,unique:categories,name'
        ]);

        $category = new Category;
        $category->name = Request::input('name');

        if(!$category->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Category was not created due to internal server error'
            ], 500);
        }

        return Response::json(['message' => 'Category created succesfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if(isNull($category)) {
            return Response::json([
                'code' => 400,
                'message' => 'Category not found.'
            ], 400);
        }

        return Response::json($category->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(isNull($category)) {
            return Response::json([
                'code' => 400,
                'message' => 'Category not found.'
            ], 400);
        }
        
        $this->validate($request, [
            'name' => 'unique:categories,name'
        ]);

        $category->name = Request::input('name');

        if(!$category->save()) {
            return Response::json([
                'code' => 500,
                'message' => 'Category was not updated due to internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Category updated succesfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(isNull($category)) {
            return Response::json([
                'code' => 400,
                'message' => 'Category not found.'
            ], 400);
        }

        if(!$category->delete()) {
            return Response::json([
                'code' => 500,
                'message' => 'Category was not deleted due to an internal server error.'
            ], 500);
        }

        return Response::json(['message' => 'Category deleted succesfully.']);
    }

}