<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterFundRequest;
use App\Http\Resources\FundResource;
use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterFundRequest $request)
    {
        return FundResource::collection(
            Fund::query()->with(['fundManager', 'aliases', 'companies'])->paginate()
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
