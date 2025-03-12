<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Google\Client;
use Google\Service\Oauth2;

/**
 * Update user information.
 *
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 */
class AuthService
{
    /**
     * AuthService constructor.
     *
     * @param Client $googleClient
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private readonly Client $googleClient,
        private readonly UserRepositoryInterface $userRepository
    ) {
        $this->googleClient->setClientId(config('services.google.client_id'));
        $this->googleClient->setClientSecret(config('services.google.client_secret'));
        $this->googleClient->setRedirectUri(route('google.callback'));
        $this->googleClient->addScope(['email', 'profile']);
    }

    /**
     * Create Google authentication URL.
     *
     * @return string
     */
    public function createAuthUrl(): string
    {
        return $this->googleClient->createAuthUrl();
    }

    /**
     * Handle Google callback and store user information.
     *
     * @param string $code
     * @return \App\Models\User
     */
    public function handleGoogleCallback(string $code)
    {
        $this->googleClient->fetchAccessTokenWithAuthCode($code);
        $token = $this->googleClient->getAccessToken();
        $oauth2 = new Oauth2($this->googleClient);
        $userInfo = $oauth2->userinfo->get();

        $user = $this->userRepository->store([
            'email' => $userInfo->email,
            'name' => $userInfo->name,
            'google_token' => $token['access_token'],
        ]);

        return $user;
    }
}
