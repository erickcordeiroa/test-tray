<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Client;
use Illuminate\Http\Request;

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
        return redirect($authUrl);
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

        return redirect('/cadastro')->with('user', $user);
    }
}
