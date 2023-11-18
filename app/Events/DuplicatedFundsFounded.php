<?php

namespace App\Events;

use App\Models\Fund;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DuplicatedFundsFounded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Fund
     */
    public Fund $fund;

    public Collection $duplications;

    /**
     * Create a new event instance.
     */
    public function __construct(Fund $fund, Collection $duplications)
    {
        $this->fund = $fund;
        $this->duplications = $duplications;
    }
}