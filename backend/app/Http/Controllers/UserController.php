<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(
        private readonly UserService $userService
    ) {}

    /**
     * List all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->userService->list();
            return response()->json($users, Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error(
                'Ocorreu um erro ao listar os usuários',
                ["ERROR" => $exception->getMessage()]
            );

            return response()->json([
                'error' => 'Ocorreu um erro ao listar os usuários'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update user information.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $data = $request->only(['google_token', 'birthdate', 'document']);
            $users = $this->userService->update($data);
            return response()->json($users, Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error(
                'Ocorreu um erro ao listar os usuários',
                ["ERROR" => $exception->getMessage()]
            );

            return response()->json([
                'error' => 'Ocorreu um erro ao listar os usuários'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
