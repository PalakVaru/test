<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserLoginRequest;
use Auth;

class LoginController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getLogin() {
        return view('auth/login');
    }

    public function login(UserLoginRequest $userLoginRequest) {
        $user = $this->userRepository->login($userLoginRequest);
        if ($user) {
            return redirect()->route('index')->with('success', 'Logged In successfully');
        } else {
            return redirect()->back()->with('success', 'Login failed');

        }
    }

    public function logout() {
        
        Auth::logout();
        return redirect('/');
    }
}
