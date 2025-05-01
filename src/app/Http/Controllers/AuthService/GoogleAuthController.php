<?php

namespace App\Http\Controllers\AuthService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Interfaces\UserAuthManagerInterface;
class GoogleAuthController extends Controller
{

    public function __construct(private UserAuthManagerInterface $userAuthManager) {
        // $this->userAuthManager = $userAuthManager;
     }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        $this->userAuthManager->authGoogleCallback();
        return redirect('/');
    }
}
