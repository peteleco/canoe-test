<?php

namespace App\Services;

use App\Http\Requests\FilterFundRequest;
use App\Http\Requests\UpdateFundRequest;
use App\Models\Fund;
use App\Models\FundAlias;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use function Termwind\renderUsing;

class FundService
{
    public function find(FilterFundRequest $request): \Illuminate\Database\Eloquent\Builder
    {
        $query = Fund::query()->with(['fundManager', 'aliases', 'companies']);

        if ($request->get('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('year')) {
            $query->where('start_year', $request->get('year'));
        }

        if ($request->get('fund_manager')) {
            $query->whereHas('fundManager', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->get('fund_manager') . '%');
            });
        }

        return $query;
    }
}