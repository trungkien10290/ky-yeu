<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $bugImageCount = rand(1, 5);
        $bugImages = [];
        for ($i = 0; $i < $bugImageCount; $i++) {
            $bugImages[] = 'images/1 (10).JPG';
        }
        return [
            'project_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'code' => '',
            'date' => date('Y-m-d'),
            'desc_vi' => $this->faker->text,
            'desc_en' => $this->faker->text,
            'reason_vi' => $this->faker->text,
            'reason_en' => $this->faker->text,
            'consequence_vi' => $this->faker->text,
            'consequence_en' => $this->faker->text,
            'solution_vi' => $this->faker->text,
            'solution_en' => $this->faker->text,
            'bug_images' => $bugImages,
            'bug_files' => $this->faker->shuffleArray(),
            'solution_images' => $bugImages,
            'solution_files' => $this->faker->shuffleArray(),
            'is_active' => rand(0, 1),
        ];
    }
}
