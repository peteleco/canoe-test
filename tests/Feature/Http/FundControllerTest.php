<?php
test('list all funds', function () {
    \App\Models\Fund::factory()->create()->count(10);
    $this->assertCount(\App\Models\Fund::query()->count(), 10);
    $response = $this->get('/api/funds');

    $response->assertStatus(200);
});
