<?php

use App\Models\Company;
use App\Models\FundAlias;

test('testing factories', function () {
    \App\Models\Fund::factory()->count(10)->create();
    $this->assertEquals(\App\Models\Fund::query()->count(), 10);
});
test('list all funds', function () {
    \App\Models\Fund::factory()
        ->has(FundAlias::factory()->count(5), 'aliases')
        ->has(Company::factory()->count(5), 'companies')
        ->count(10)->create();

    $response = $this->get('/api/funds');
    $response->assertJsonPath('meta.total', 10);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'start_year',
                'aliases',
                'fund_manager',
                'companies' => [
                    '*' => [
                        'id', 'name',
                    ],
                ],
            ],
        ],
        'links',
        'meta',
    ]);

    $response->assertStatus(200);
});
