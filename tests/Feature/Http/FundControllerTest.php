<?php

use App\Models\Company;
use App\Models\FundAlias;
use App\Models\FundManager;

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

test('list filtered funds', function () {
    \App\Models\Fund::factory()
        ->has(FundAlias::factory()->count(5), 'aliases')
        ->has(Company::factory()->count(5), 'companies')
        ->count(10)->create();

    \App\Models\Fund::factory()
        ->has(FundAlias::factory()->count(5), 'aliases')
        ->has(Company::factory()->count(5), 'companies')
        ->create([
            'fund_manager_id' => FundManager::factory([
                'name' => 'Canoe',
            ]),
            'name' => 'Canoe',
            'start_year' => '2023',
        ]);

    $response = $this->getJson(route('api.funds.index', [
            'name' => 'Canoe',
            'fund_manager' => 'Canoe',
            'year' => 2023,
        ]
    ));
    $response->assertJsonPath('meta.total', 1);

    $response->assertStatus(200);
});

test('update fund', function () {
    $fund = \App\Models\Fund::factory()
        ->has(FundAlias::factory(['name' => 'alias 1']), 'aliases')
        ->has(FundAlias::factory(['name' => 'alias 2']), 'aliases')
        ->has(Company::factory(['name' => 'company 1']), 'companies')
        ->has(Company::factory(['name' => 'company 2']), 'companies')
        ->create(['name' => 'Canoe fund', 'start_year' => 2021]);
    $fund->load(['aliases', 'fundManager', 'companies']);

    $newFundManager = \App\Models\FundManager::factory()->create(['name' => 'New fund manager']);
    $newCompany = Company::factory()->create(['name' => 'Company 3']);
    $response = $this->putJson(route('api.funds.update', ['fund' => $fund->getKey()]), [
        'name' => 'Canoe updated fund',
        'start_year' => 2022,
        'fund_manager_id' => $newFundManager->getKey(),
        'aliases' => [
            'alias 2',
            'Alias 4',
            'Alias 5',
        ],
        'companies' => [
            $newCompany->getKey(),
        ],
    ]);

    $response->assertJsonPath('data.name', 'Canoe updated fund');
    $response->assertJsonPath('data.start_year', 2022);
    $response->assertJsonPath('data.fund_manager', $newFundManager->name);
    $response->assertJsonPath('data.aliases.0', 'alias 2');
    $response->assertJsonPath('data.aliases.1', 'Alias 4');
    $response->assertJsonPath('data.aliases.2', 'Alias 5');
    $response->assertJsonPath('data.companies.0.name', 'Company 3');

    $response->assertStatus(200);
});
