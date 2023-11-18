<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterFundRequest;
use App\Http\Resources\FundResource;
use App\Models\Fund;
use App\Services\FundService;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterFundRequest $request, FundService $service)
    {
        return FundResource::collection($service->find($request)->paginate());
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }
}
