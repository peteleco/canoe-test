<?php
test('testing factories', function () {
    \App\Models\Fund::factory()->count(10)->create();
    $this->assertEquals(\App\Models\Fund::query()->count(), 10);
});
test('list all funds', function () {
    $response = $this->get('/api/funds');

    $response->assertStatus(200);
});
