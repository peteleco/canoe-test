<?php

namespace App\Listeners;

use App\Events\DuplicatedFundsFounded;
use App\Mail\PossibleDuplicatedFundFounded;
use Illuminate\Mail\Message;
use Mail;

class WarnDuplicatedFunds
{
    public function handle(DuplicatedFundsFounded $event): void
    {
        Mail::to('test@canoe.com')->send(new PossibleDuplicatedFundFounded($event->fund, $event->duplications));
    }
}