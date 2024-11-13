<?php

namespace Database\Factories;

use App\Models\BoardsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arrImg = [
            '/img/sodubear.jpg'
            ,'/img/sodubear_holiday.webp'
            ,'/img/sodubear_racoon.png'
            ,'/img/sodubear_sweater.jpg'
            ,'/img/sodubear_santa.png'
            ,'/img/sodubear_twins.png'
            ,'/img/wanna_go_home.png'
            ,'/img/panda.jpg'
            ,'/img/nonono.jpg'
            ,'/img/meerkat_what.jpg'
            ,'/img/meerkat_bite.jpg'
            ,'/img/tako.jpg'
        ];
        $userInfo = User::inRandomOrder()->first();

        $date = $this->faker->dateTimeBetween($userInfo->created_at);

        return [
            'u_id' => $userInfo->u_id
            ,'bc_type' => BoardsCategory::inRandomOrder()->first()->bc_type
            ,'b_title' => $this->faker->realText(50)
            ,'b_content' => $this->faker->realText(200)
            ,'b_img' => Arr::random($arrImg)
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
