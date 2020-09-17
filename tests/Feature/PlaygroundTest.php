<?php

namespace Tests\Feature;

use App\Models\Playground;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PlaygroundTest extends TestCase
{
    use RefreshDatabase;

    public function test_playground_can_be_retrieved()
    {
        $playground = Playground::factory()->create([
            'html' => 'test html',
            'css' => 'test css',
            'config' => 'test config',
        ]);

        $response = $this->get('/api/playgrounds/'.$playground->id);

        $response->assertStatus(200);

        $response->assertJson([
            'html' => 'test html',
            'css' => 'test css',
            'config' => 'test config',
        ]);
    }

    public function test_playground_can_be_created()
    {
        $response = $this->postJson('/api/playgrounds', [
            'uuid' => $uuid = Str::random(10),
            'html' => 'test html',
            'css' => 'test css',
            'config' => 'test config',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'html' => 'test html',
            'css' => 'test css',
            'config' => 'test config',
        ]);

        $playground = Playground::find($response['id']);

        $this->assertEquals($uuid, $playground->uuid);
        $this->assertEquals('test html', $playground->html);
        $this->assertEquals('test css', $playground->css);
        $this->assertEquals('test config', $playground->config);
    }
}
