<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cep' => $this->faker->postcode(),
            'pais' => $this->faker->country(),
            'estado' => $this->faker->state(),
            'cidade' => $this->faker->city(),
            'bairro' => $this->faker->word(),
            'endereco' => $this->faker->address(),
            'complemento' => $this->faker->sentence(3, true),
            'user_id' =>  $this->faker->unique(true)->randomElement(User::pluck('id')->toArray())
        ];
    }
}
