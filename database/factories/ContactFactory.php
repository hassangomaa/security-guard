<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'date_and_time' => $this->faker->dateTime(),
            'service' => $this->faker->randomElement(['Penetration testing', 'Cyber risk assessment', 'Cyber ​​security design', 'Network security', 'Website security']),
            'meeting_type' => $this->faker->randomElement(['Chatting', 'Meeting']),
        ];
    }
}
