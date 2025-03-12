<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Exception;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function list()
    {
        //TODO: COLOCAR O FILTRO AQUI NESSE METODO
        return $this->userRepository->list();
    }

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
