<?php

namespace App\Services;

use App\Interfaces\SendMailRepositoryInterface;
use App\Models\User;

class MailService
{
    public function __construct(
        private readonly SendMailRepositoryInterface $sendMailRepository
    ) {}

    public function sendMail(User $user): void
    {
        $this->sendMailRepository->send($user);
    }
}