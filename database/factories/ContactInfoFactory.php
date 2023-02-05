<?php

namespace Database\Factories;

use App\Models\ContactInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactInfoFactory extends Factory
{
    protected $model = ContactInfo::class;

    public function definition(): array
    {
        $enableTypes = ['phone', 'email', 'location'];
        $type = $enableTypes[rand(0, 2)];
        switch ($type) {
            case 'phone':
                $value = $this->faker->phoneNumber;
                break;
            case 'email':
                $value = $this->faker->email;
                break;
            case 'location':
                $value = $this->faker->latitude . ',' . $this->faker->longitude;
                break;
        }


        return [
            'info_type' => $type,
            'info_value' => $value
        ];
    }
}
