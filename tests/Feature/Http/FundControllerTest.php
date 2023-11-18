<?php
test('list all funds', function () {
    $response = $this->get('/api/funds');

    $response->assertStatus(200);
});
