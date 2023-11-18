<?php
test('testing factories', function () {
    \App\Models\Fund::factory()->count(10)->create();
    $this->assertEquals(\App\Models\Fund::query()->count(), 10);
});
test('list all funds', function () {
    \App\Models\Fund::factory()->count(10)->create();
    $response = $this->get('/api/funds');
    $response->assertJsonPath('meta.total', 10);
    $response->assertStatus(200);
});
