<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.callback'));
        $client->addScope('email');
        $client->addScope('profile');

        $authUrl = $client->createAuthUrl();
        return response()->json(
            [
                'url' => $authUrl
            ],
            Response::HTTP_OK
        );
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.callback'));

        $client->fetchAccessTokenWithAuthCode($request->code);

        $token = $client->getAccessToken();

        $oauth2 = new \Google\Service\Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        $user = User::updateOrCreate(
            ['email' => $userInfo->email],
            [
                'google_token' => $token['access_token'],
                'name' => $userInfo->name,
                'email' => $userInfo->email,
            ]
        );

        //TODO: validar como melhorar essa opção;
        echo "<script>
                window.opener.postMessage(" . json_encode([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_token' => $token['access_token']
                    ]) . ", 'http://localhost:5173');
                window.close();
            </script>";
    }
}
