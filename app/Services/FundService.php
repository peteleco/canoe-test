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

    public function update(UpdateFundRequest $request, Fund $fund): Fund
    {
        return DB::transaction(function () use ($request, $fund) {
            $fund->update([
                'fund_manager_id' => $request->input('fund_manager_id'),
                'name' => $request->input('name'),
                'start_year' => $request->input('start_year'),
            ]);
            if($request->input('aliases')) {
                $this->updateAliases($fund, $request->input('aliases'));
            }
            if($request->input('companies')) {
                $this->updateCompanies($fund, $request->input('companies'));
            }

            return $fund->refresh();
        });
    }

    private function updateAliases(Fund $fund, array $aliases): void
    {
        $aliases = collect($aliases)->map(function ($alias) use ($fund) {
            return FundAlias::firstOrCreate([
                'fund_id' => $fund->id,
                'name' => $alias,
            ]);
        });
        $fund->aliases->diff($aliases)->each->delete();
    }

    private function updateCompanies(Fund $fund, array $companies): void
    {
        $fund->companies()->sync($companies);
    }
}