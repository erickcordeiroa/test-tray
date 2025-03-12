<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function list(): Collection
    {
        return User::all();
    }

    public function store(array $attributes): User
    {
        return User::updateOrCreate(
            ['email' => $attributes['email']],
            [
                'google_token' => $attributes['google_token'],
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]
        );
    }

    public function update(array $attributes): ?bool
    {
        $user = User::where('google_token', $attributes['google_token'])->first();
        if (!$user) {
            return null;
        }

        return $user->update([
            'birthdate' => $attributes['birthdate'],
            'document' => $attributes['document']
        ], [
            'id' => $user->id
        ]);
    }
}
