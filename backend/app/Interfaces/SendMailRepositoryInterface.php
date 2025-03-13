<?php

namespace App\Interfaces;

use App\Models\User;

interface SendMailRepositoryInterface
{
    public function send(User $user): void;
}