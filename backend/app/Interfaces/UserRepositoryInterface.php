<?php 

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface {
    public function list(): Collection;
    public function store(array $attributes): User;
    public function update(array $attributes): ?bool;
}