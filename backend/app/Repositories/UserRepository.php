<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function list(): LengthAwarePaginator
    {
        return User::select([
            "email", 
            "name", 
            "document", 
            "birthdate"
        ])->paginate(15);
    }

    public function search(string $search): LengthAwarePaginator
    {
        return User::select([
            "email", 
            "name", 
            "document", 
            "birthdate"
        ])->when($search, function($query) use ($search) {
            $query->orWhere('document', 'like', "%{$search}%");
            $query->orWhere('name', 'like', "%{$search}%");
        })
        ->paginate(15);
    }


    public function getOne(string $googleToken): User
    {
        return User::where("google_token", $googleToken)->first();
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
