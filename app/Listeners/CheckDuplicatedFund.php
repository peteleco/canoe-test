<?php

namespace App\Listeners;

use App\Events\FundCreated;
use App\Events\DuplicatedFundsFounded;
use App\Services\FundService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckDuplicatedFund
{
    private FundService $fundService;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param FundCreated $event
     *
     * @return void
     */
    public function handle(FundCreated $event): void
    {
    }
}