<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'yousef',
            'email' => 'jooyehia611@gmail.com',
            'username' => 'superadmin',
            'role' => 'SuperAdmin',
            'about' => 'superadmin',
            'phone' => '01123223217',
            'wphone' => '01123223217',
            'facebook' => 'jooyehia611',
            'pay' => 'vcash',
            'vcashe' => '01123223217',
            'card' => '2334454549393',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
