<?php

require 'vendor/autoload.php';

use Faker\Factory;

class Random
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('en_PH'); // Set locale to 'en_PH' for Philippine data
    }

    public function generatePerson()
    {
        return [
            $this->faker->uuid,
            $this->faker->title,
            $this->faker->firstName,
            $this->faker->lastName,
            $this->faker->streetAddress,
            $this->faker->city, // For Barangay
            $this->faker->city,
            $this->faker->state, // For Province
            $this->faker->country,
            $this->faker->phoneNumber, // Use phoneNumber for both phone and mobile numbers
            $this->faker->phoneNumber, // Use phoneNumber for both phone and mobile numbers
            $this->faker->company,
            $this->faker->url,
            $this->faker->jobTitle,
            $this->faker->safeColorName,
            $this->faker->dateTime->format('Y-m-d'), // Correct way to generate date
            $this->faker->email,
            $this->faker->password,
        ];
    }
}
