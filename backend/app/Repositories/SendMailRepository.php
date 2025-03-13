<?php

namespace App\Repositories;

use App\Mail\UserRegisteredMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\SendMailRepositoryInterface;

class SendMailRepository implements SendMailRepositoryInterface
{
    public function send(User $user): void 
    {
        Mail::to($user->email)->queue(new UserRegisteredMail($user));
    }
}