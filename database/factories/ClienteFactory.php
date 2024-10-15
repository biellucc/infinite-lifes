<?php

namespace Database\Factories;

use App\Models\User;
use App\Services\criptografiaService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $criptografiaService = new criptografiaService();
        $cpf = $this->faker->numerify('###.###.###-##');
        $cpf = $criptografiaService->criptografarCpf($cpf);
        return [
            'nome' => $this->faker->firstName(null),
            'sobrenome' => $this->faker->lastName(null),
            'cpf' => $cpf,
            'data_nascimento' => $this->faker->date(),
            'user_id' =>  $this->faker->unique(true)->randomElement(User::pluck('id')->toArray())
        ];
    }
}
