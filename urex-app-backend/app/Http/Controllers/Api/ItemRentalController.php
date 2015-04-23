<?php namespace App\Http\Controllers\Api;

use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\ItemRental;
use App\Traits\UrexExecutionHandlerTrait;

class ItemRentalController extends ApiGuardController {

    use UrexExecutionHandlerTrait;

    protected $apiMethods = [
        'index' => [ 'keyAuthentication' => false ],
        'show' => [ 'keyAuthentication' => false ]
    ];

    public function index()
    {
        return Response::json(ItemRental::all()->toArray());
    }

    public function store()
    {
        return $this->attemptExecution(function() {
            ItemRental::create(Request::all());
            return Response::json(['message' => 'Item created successfully.']);
        });
    }

    public function show($id)
    {
        return $this->attemptExecution(function() use ($id) {
            return Response::json(ItemRental::find($id)->toArray());
        });
    }

    public function update($id)
    {
        return $this->attemptExecution(function() use ($id) {
            ItemRental::find($id)->update(Request::all());
            return Response::json(['message' => 'Item updated successfully.']);
        });
    }

    public function destroy($id)
    {
        return $this->attemptExecution(function() use ($id) {
            ItemRental::find($id)->delete();
            return Response::json(['message' => 'Item deleted successfully.']);
        });
    }

}
