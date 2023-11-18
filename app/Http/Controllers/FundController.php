<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterFundRequest;
use App\Http\Requests\UpdateFundRequest;
use App\Http\Resources\FundResource;
use App\Models\Fund;
use App\Services\FundService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function update(UpdateFundRequest $request, Fund $fund, FundService $service)
    {
        try {
            return FundResource::make($service->update($request, $fund));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
