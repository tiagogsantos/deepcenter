<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Profile;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cria_um_usuario_com_sucesso()
    {
        $payload = [
            'name'           => fake()->name(),
            'email'          => fake()->unique()->safeEmail(),
            'marital_status' => 'single',
            'zipcode'        => '12345-678',
            'cpf'            => '12345678910',
            'rg'             => '1234567',
            'date_birth'     => '2000-01-01',
            'address'        => fake()->streetAddress(),
            'number'         => '100',
            'neighborhood'   => fake()->citySuffix(),
            'city'           => fake()->city(),
            'state'          => 'SP',
            'uf'             => 'SP',
            'phone_number'   => '11999999999'
        ];

        $response = $this->postJson(route('store.user'), $payload);

        $response->assertStatus(201);
        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('users', [
            'email' => $payload['email']
        ]);
    }

    /** @test */
    public function atualiza_um_usuario_com_sucesso()
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);

        $payload = [
            'name'           => 'Nome Atualizado',
            'email'          => fake()->unique()->safeEmail(),
            'marital_status' => 'married',
            'zipcode'        => '99999-000',
            'cpf'            => '12345678999',
            'rg'             => '4444444',
            'date_birth'     => '1995-01-01',
            'address'        => 'Rua Nova',
            'number'         => '200',
            'neighborhood'   => 'Bairro Novo',
            'city'           => 'Rio de Janeiro',
            'state'          => 'RJ',
            'uf'             => 'RJ',
            'phone_number'   => '21999999999',
        ];

        $response = $this->postJson(
            route('update.user', $user->id),
            $payload
        );

        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('users', [
            'id'   => $user->id,
            'name' => 'Nome Atualizado'
        ]);
    }

    /** @test */
    public function remove_um_usuario_com_sucesso()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('destroy.user'), [
            'id' => $user->id
        ]);

        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
