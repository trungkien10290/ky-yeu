<?php

namespace Database\Factories;

use App\Constants\AppConstants;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CategoryFactory extends Factory
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
            'type' => Arr::random(array_keys(AppConstants::CATEGORY_TYPES)),
            'desc_vi' => $this->faker->paragraph,
            'desc_en' => $this->faker->paragraph,
            'content_vi' => $this->faker->paragraph,
            'content_en' => $this->faker->paragraph,
            'thumbnail' => '',
            'banner' => '',
            'logo' => '',
            'parent_id' => 0,
            'is_active' => 1,
        ];
    }
}
