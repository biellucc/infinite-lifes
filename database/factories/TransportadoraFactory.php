<?php

namespace Database\Factories;

use App\Models\Administrador;
use App\Models\User;
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
        return [
            'empresa' => $this->faker->company(),
            'user_id' => User::pluck('id')->random(),
            'administrador_id' => Administrador::pluck('id')->random(),
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
        ];
    }
}
