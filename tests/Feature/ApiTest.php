<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Test que l'API de test retourne une réponse réussie.
     */
    public function test_api_endpoint_returns_successful_response(): void
    {
        $response = $this->get('/api/test');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'API fonctionne correctement',
                     'status' => 'success'
                 ])
                 ->assertJsonStructure([
                     'message',
                     'status',
                     'timestamp'
                 ]);
    }

    /**
     * Test que l'API retourne du JSON valide.
     */
    public function test_api_returns_valid_json(): void
    {
        $response = $this->get('/api/test');

        $response->assertHeader('content-type', 'application/json');
        $this->assertJson($response->getContent());
    }

    /**
     * Test que l'API contient les champs requis.
     */
    public function test_api_contains_required_fields(): void
    {
        $response = $this->get('/api/test');
        
        $data = $response->json();
        
        $this->assertArrayHasKey('message', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('timestamp', $data);
        $this->assertEquals('success', $data['status']);
    }
}
