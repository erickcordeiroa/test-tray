<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
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
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository)
    {}

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
        $user = $this->userRepository->update($attributes);

        if (is_null($user)) {
            throw new Exception('Usuário não encontrado para atualização.');
        }

        //TODO: COLOCAR O ENVIO DE E-MAIL PELA FILA AQUI
        return $user;
    }
}