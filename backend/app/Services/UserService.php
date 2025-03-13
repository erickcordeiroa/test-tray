<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserService
 *
 * @package App\Services
 */
class UserService
{
    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param MailService $mailService
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly MailService $mailService
    ){}

    /**
     * List all users.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator;
     */
    public function list(): LengthAwarePaginator  
    {
        return $this->userRepository->list();
    }

    /**
     * Search users.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator;
     */
    public function search(string $search): LengthAwarePaginator  
    {
        return $this->userRepository->search($search);
    }

    /**
     * Update user information.
     *
     * @param array $attributes
     * @return \App\Models\User|null
     * @throws Exception
     */
    public function update(array $attributes)
    {
        $response = $this->userRepository->update($attributes);
        if (is_null($response)) {
            throw new Exception('Usuário não encontrado para atualização.');
        }

        $user = $this->userRepository->getOne($attributes['google_token']);
        $this->mailService->sendMail($user);
        return $user;
    }
}