<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $email = 'Admin' . Str::random(2) . '@gmail.com';

        $password = Str::password(16, true, true, true, false);
        $passwordHash = Hash::make($password);

        Log::channel('seeding')->info(
            'email:' . $email . "\n"
                . 'password:' . $password
        );

        return [
            'email' => $email,
            'password' => $passwordHash,
            'full_name' => 'none',
            'iin' => '12345',
            'ict' => '12345',
            'speciality' => 'speciality',
            'educational_institution' => 'school',
            'privilege' => 'Admin',
        ];
    }
}
