<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Country;

class LoanSimulationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed a default country
        Country::factory()->create([
            'code' => 'JOR',
            'interest_rate' => 5.0,
            'currency_code' => 'JOD',
        ]);
    }

    public function test_custom_interest_rate_changes_payment_and_returns_flag()
    {
        $payload = [
            'country_id' => Country::first()->id,
            'loan_amount' => 10000,
            'duration_years' => 5,
            'interest_rate' => 5.0,
        ];

        $response = $this->postJson(route('loan.simulation.calculate', ['locale' => 'en']), $payload);
        $response->assertStatus(200);
        $json1 = $response->json();
        $this->assertArrayHasKey('monthly_payment', $json1);
        $this->assertArrayHasKey('used_custom_rate', $json1);
        $this->assertFalse($json1['used_custom_rate']);

        // Now use a higher custom rate
        $payload['interest_rate'] = 8.0;
        $response = $this->postJson(route('loan.simulation.calculate', ['locale' => 'en']), $payload);
        $response->assertStatus(200);
        $json2 = $response->json();
        $this->assertTrue($json2['used_custom_rate']);

        // Monthly payment should be larger with higher interest
        $this->assertTrue($json2['monthly_payment'] > $json1['monthly_payment']);
    }
}
