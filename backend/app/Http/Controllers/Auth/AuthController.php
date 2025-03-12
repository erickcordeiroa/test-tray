<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * Redirect to Google authentication URL.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        try {
            $url = $this->authService->createAuthUrl();
            return response()->json(['url' => $url], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error(
                'Erro ao redirecionar para o google',
                ['ERROR' => $exception->getMessage()]
            );

            return response()
                ->json(
                    ['error' => 'Erro ao redirecionar para o google'],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }

    /**
     * Handle Google callback.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function handleGoogleCallback(Request $request)
    {

        try {
            $userCallBack = $this->authService->handleGoogleCallback($request->code);
            
            // Passando os dados para a view que irá executar o JavaScript
            return response()->view('popupClose', [
                'name' => $userCallBack->name,
                'email' => $userCallBack->email,
                'google_token' => $userCallBack->google_token
            ]);
        } catch (Exception $exception) {
            Log::error(
                'Erro ao receber o callback do google',
                ['ERROR' => $exception->getMessage()]
            );

            return response()
                ->json(
                    ['error' => 'Erro ao receber o callback do google'],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
