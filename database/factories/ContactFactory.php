<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

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
            'uuid' => $this->faker->uuid,
            'info_type' => $type,
            'info_value' => $value
        ];
    }
}
