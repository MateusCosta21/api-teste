<?php

namespace Tests\Feature;

use App\Services\Sugestoes\SugestaoService;
use App\Http\Controllers\SugestaoController;
use App\Http\Requests\UpdateSugestaoRequest;
use App\Http\Resources\SugestoesResource;
use Mockery;
use Tests\TestCase;

class SugestaoControllerTest extends TestCase
{
    public function test_listar_pendentes()
    {
        $sugestaoServiceMock = Mockery::mock(SugestaoService::class);
        $sugestaoServiceMock->shouldReceive('listarSugestoes')->andReturn(collect([
            [
                'id' => 1,
                'user_id' => 1,
                'titulo' => 'Sugestão 1',
                'youtube_id' => 'xyz123',
                'thumb' => 'thumb1.jpg',
                'visualizacoes' => 100,
                'status' => 'pendente',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'titulo' => 'Sugestão 2',
                'youtube_id' => 'abc456',
                'thumb' => 'thumb2.jpg',
                'visualizacoes' => 150,
                'status' => 'pendente',
            ]
        ]));
    
        $this->app->instance(SugestaoService::class, $sugestaoServiceMock);
    
        $response = $this->getJson('/api/sugestoes/pendentes');
    
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => 1,
                'user_id' => 1,
                'titulo' => 'Sugestão 1',
                'youtube_id' => 'xyz123',
                'thumb' => 'thumb1.jpg',
                'visualizacoes' => 100,
                'status' => 'pendente',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'titulo' => 'Sugestão 2',
                'youtube_id' => 'abc456',
                'thumb' => 'thumb2.jpg',
                'visualizacoes' => 150,
                'status' => 'pendente',
            ],
        ]);
    }
    public function test_sugerir()
    {
        $sugestaoServiceMock = Mockery::mock(SugestaoService::class);
        $sugestaoServiceMock->shouldReceive('sugerirMusica')->andReturn([
            'id' => 1,
            'user_id' => 1,
            'titulo' => 'Sugestão Teste',
            'youtube_id' => 'def789',
            'thumb' => 'thumb.jpg',
            'visualizacoes' => 50,
            'status' => 'pendente',
        ]);
    
        $this->app->instance(SugestaoService::class, $sugestaoServiceMock);
    
        $dados = [
            'url' => 'https://youtube.com/test-video',
        ];
    
        $response = $this->postJson('/api/sugestoes', $dados);
    
        $response->assertStatus(201);
        $response->assertJson([
            'id' => 1,
            'user_id' => 1,
            'titulo' => 'Sugestão Teste',
            'youtube_id' => 'def789',
            'thumb' => 'thumb.jpg',
            'visualizacoes' => 50,
            'status' => 'pendente',
        ]);
    }

    public function test_update_status()
    {
        $sugestaoServiceMock = Mockery::mock(SugestaoService::class);
        $sugestaoServiceMock->shouldReceive('updateStatus')->andReturn([
            'id' => 1,
            'user_id' => 1,
            'titulo' => 'Sugestão Teste',
            'youtube_id' => 'def789',
            'thumb' => 'thumb.jpg',
            'visualizacoes' => 50,
            'status' => 'aprovada',
        ]);
    
        $this->app->instance(SugestaoService::class, $sugestaoServiceMock);
    
        $dados = [
            'status' => 'aprovada',
        ];
    
        $response = $this->putJson('/api/sugestoes/1/status', $dados);
    
        $response->assertStatus(200);
        $response->assertJson([
            'id' => 1,
            'user_id' => 1,
            'titulo' => 'Sugestão Teste',
            'youtube_id' => 'def789',
            'thumb' => 'thumb.jpg',
            'visualizacoes' => 50,
            'status' => 'aprovada',
        ]);
    }
}
