<?php

namespace Tests\Feature;

use App\Http\Controllers\MusicasController;
use App\Services\Musicas\MusicaService;
use App\Http\Requests\MusicaRequest;
use App\Http\Resources\MusicasResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class MusicasControllerTest extends TestCase
{
    public function test_index()
    {
        $musicaServiceMock = Mockery::mock(MusicaService::class);
        $musicaServiceMock->shouldReceive('listarMusicas')->andReturn(collect([]));

        $this->app->instance(MusicaService::class, $musicaServiceMock);

        $response = $this->getJson('/api/musicas');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nome', 'visualizacoes']
            ]
        ]);
    }

    public function test_store()
    {
        $musicaServiceMock = Mockery::mock(MusicaService::class);
        $musicaServiceMock->shouldReceive('salvarMusica')->andReturn(collect([
            'id' => 1,
            'titulo' => 'Nova Música',
            'youtube_id' => 'abc123',
            'thumb' => 'thumbnail.jpg',
            'visualizacoes' => 100,
            'approved' => false,
        ]));
    
        $this->app->instance(MusicaService::class, $musicaServiceMock);
    
        $data = [
            'titulo' => 'Nova Música',
            'youtube_id' => 'abc123',
            'thumb' => 'thumbnail.jpg',
            'visualizacoes' => 100,
            'approved' => false,
        ];
    
        $response = $this->postJson('/api/musicas', $data);
    
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Música Criada com sucesso.',
            'data' => [
                'titulo' => 'Nova Música',
                'youtube_id' => 'abc123',
                'thumb' => 'thumbnail.jpg',
                'visualizacoes' => 100,
                'approved' => false,
            ],
        ]);
    }

    public function test_update()
    {
        $musicaServiceMock = Mockery::mock(MusicaService::class);
        $musicaServiceMock->shouldReceive('atualizarMusica')->andReturn(collect([
            'id' => 1,
            'titulo' => 'Música Atualizada',
            'youtube_id' => 'xyz789',
            'thumb' => 'updated_thumbnail.jpg',
            'visualizacoes' => 200,
            'approved' => true,
        ]));
    
        $this->app->instance(MusicaService::class, $musicaServiceMock);
    
        $data = [
            'titulo' => 'Música Atualizada',
            'youtube_id' => 'xyz789',
            'thumb' => 'updated_thumbnail.jpg',
            'visualizacoes' => 200,
            'approved' => true,
        ];
    
        $response = $this->putJson('/api/musicas/1', $data);
    
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'titulo' => 'Música Atualizada',
                'youtube_id' => 'xyz789',
                'thumb' => 'updated_thumbnail.jpg',
                'visualizacoes' => 200,
                'approved' => true,
            ],
        ]);
    }

    public function test_destroy()
    {
        $musicaServiceMock = Mockery::mock(MusicaService::class);
        $musicaServiceMock->shouldReceive('excluirMusica')->once();
    
        $this->app->instance(MusicaService::class, $musicaServiceMock);
    
        $response = $this->deleteJson('/api/musicas/1');
    
        $response->assertStatus(204);
    }
}
