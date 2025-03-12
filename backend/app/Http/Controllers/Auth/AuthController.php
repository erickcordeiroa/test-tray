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

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ) {}
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

    public function handleGoogleCallback(Request $request)
    {

        try {
            $userCallBack = $this->authService->handleGoogleCallback($request->code);
            //TODO: SABER COMO MELHORAR ESSA PARTE
            echo "<script>
                    window.opener.postMessage(" . json_encode([
                            'name' => $userCallBack->name,
                            'email' => $userCallBack->email,
                            'google_token' => $userCallBack->google_token
                        ]) . ", 'http://localhost:5173');
                    window.close();
                </script>";

                return;
            // return response()->json(['user' => $userCallBack], Response::HTTP_OK);
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
