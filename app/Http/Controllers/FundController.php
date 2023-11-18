<?php

namespace App\Http\Controllers;

use App\Http\Resources\FundResource;
use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FundResource::collection(
            Fund::query()->paginate()
        );
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }
}
