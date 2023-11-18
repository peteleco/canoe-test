<?php

use Illuminate\Support\Facades\Event;

test('check duplicated fund name', function () {
    Event::fake([
        \App\Events\DuplicatedFundsFounded::class,
    ]);
    // Perform order shipping...
    $fund = \App\Models\Fund::factory()->hasAliases(1, ['name' => 'Alias'])->create(['name' => 'Fund name']);
    $fund->load(['fundManager', 'aliases']);
    $fundSameName = \App\Models\Fund::factory()->create([
        'fund_manager_id' => $fund->fund_manager_id,
        'name' => 'Fund Name',
    ]);
    // Assert that an event was dispatched...
    Event::assertDispatched(\App\Events\DuplicatedFundsFounded::class);
});

test('check duplicated fund name at localhost:8025', function () {
    // Perform order shipping...
    $fund = \App\Models\Fund::factory()->hasAliases(1, ['name' => 'Alias'])->create(['name' => 'Fund name']);
    $fund->load(['fundManager', 'aliases']);
    $fundSameName = \App\Models\Fund::factory()->create([
        'fund_manager_id' => $fund->fund_manager_id,
        'name' => 'Fund Name',
    ]);
});