<?php

namespace Database\Factories;

use App\Constants\AppConstants;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_vi' => $this->faker->text,
            'title_en' => $this->faker->text,
            'desc_vi' => $this->faker->paragraph,
            'desc_en' => $this->faker->paragraph,
            'content_vi' => $this->faker->paragraph,
            'content_en' => $this->faker->paragraph,
            'thumbnail' => '',
            'logo' => '',
            'is_active' => 1,
        ];
    }
}
