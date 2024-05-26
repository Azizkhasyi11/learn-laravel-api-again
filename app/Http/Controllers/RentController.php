<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @queryParam page_size How big the data is. Defaults to '10'.
     */
    public function index(Request $request)
    {
        $rents = Rent::paginate($request->page_size ?? 10);

        if ($rents->count() > 0){
            return response()->json([
                'message' => 'Success',
                'data' => $rents
            ]);
        } else {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentRequest $request)
    {
        $credentials = $request->validated();

        if($credentials) {
            $rent = new Rent($credentials);
            $rent->save();

            return response()->json([
                'messages' => 'Data have been saved',
                'data' => $rent
            ], 200);
        }

        return response()->json([
            'messages' => 'Invalid',
        ], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        return response()->json([
            'message' => 'Success',
            'data' => $rent
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $credentials = $request->validated();

        if($credentials) {
            $rent->update($credentials);

            return response()->json([
                'messages' => 'Data have been updated',
                'data' => $rent
            ], 200);
        }

        return response()->json([
            'messages' => 'Invalid',
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        $delete = $rent->forceDelete();

        if($delete) {
            return response()->json([
                'messages' => 'Data have been deleted',
            ], 200);
        }

        return response()->json([
            'messages' => 'Invalid',
        ], 422);
    }
}
