<?php

namespace Database\Factories;

use App\Models\Administrador;
use App\Models\User;
use App\Services\criptografiaService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transportadora>
 */
class TransportadoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $criptografiaService = new criptografiaService();
        $cnpj =  $this->faker->numerify('##.###.###/####-##');
        $cnpj = $criptografiaService->criptografarCnpj($cnpj);
        return [
            'empresa' => $this->faker->company(),
            'user_id' =>  $this->faker->unique(true)->randomElement(User::pluck('id')->toArray()),
            'administrador_id' => Administrador::pluck('id')->random(),
            'cnpj' => $cnpj
        ];
    }
}
