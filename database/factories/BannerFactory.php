<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
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
            'thumbnail' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png',
        ];
    }

}
