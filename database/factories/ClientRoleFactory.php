<?php

namespace Database\Factories;

use App\Models\Services\Client;
use App\Models\ClientRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ClientRoleFactory extends Factory
{
    const CLIENTS = [
        User::class,
        Client::class,
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientRole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model_type = Arr::random(self::CLIENTS);

        return [
            'role_id'     => resolve(Role::class)->inRandomOrder()->first()->id,
            'client_type' => $model_type,
            'client_id'   => resolve($model_type)->inRandomOrder()->first()->id,
        ];
    }
}
