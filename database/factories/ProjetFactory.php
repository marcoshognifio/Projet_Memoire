<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'nom' => fake()->sentence(),
            'createur_id' =>fake()->randomElement([3,2]),
            'administrateur_id' =>fake()->randomElement([3,2]),
            'description' =>fake()->paragraph(),
            'recette_actuelle' =>fake()->randomElement([0,1.2,2.9]),
            'depense_actuelle' =>fake()->randomElement([0,1.2,2.9]),
            'budget' =>fake()->randomElement([1000,2000]),
            'date_fin' =>fake()->randomElement([NULL]),
            'projet_parent_id' => fake()->randomElement([40,41,43,44,45,48]),
            'image' => fake()->randomElement([
                'projets_images/tRy6qq4WiF47wR2nA9BvqoBpwgJFhZqLFzcoq3D5.jpg',
                'projets_images/d5cttS3yE5HU1wC0DFG2mXLUz211hzkMH4PtJJV8.jpg'])
        ];
    }
}
