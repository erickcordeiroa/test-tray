<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\SendMailRepositoryInterface;
use App\Models\User;
use Exception;

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
     * @param SendMailRepositoryInterface $sendMailRepository
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly SendMailRepositoryInterface $sendMailRepository
    ){}

    /**
     * List all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        //TODO: COLOCAR O FILTRO AQUI NESSE METODO
        return $this->userRepository->list();
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
        $this->sendMail($user);
        return $user;
    }

    private function sendMail(User $user): void
    {
        $this->sendMailRepository->send($user);
    }
}