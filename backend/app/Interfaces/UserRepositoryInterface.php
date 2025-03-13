<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function list(): LengthAwarePaginator;
    public function search(string $search): LengthAwarePaginator;
    public function getOne(string $googleToken): User;
    public function store(array $attributes): User;
    public function update(array $attributes): ?bool;
}
