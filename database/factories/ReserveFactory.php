<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availableHour = $this->faker->numberBetween(10, 18); //10時から18時
        $minutes = [0, 30]; //0分か30分
        $mkey = array_rand($minutes);
        $addHour = $this->faker->numberBetween(1, 3); //イベント時間１~３時間

        $dummyDate = $this->faker->dateTimeThisMonth;
        $startDate = $dummyDate->setTime($availableHour, $minutes[$mkey]);
        $clone = clone $startDate;
        $endDate = $clone->modify('+'.$addHour.'hour');

        // dd($startDate, $endDate);

        return [
            'name' => $this->faker->name,
            'menu' => $this->faker->numberBetween(1,5),
            'stylist' => $this->faker->name,
            'message' => $this->faker->realText,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }
}
