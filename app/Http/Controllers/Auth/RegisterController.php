<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\userRegisterRequest;

class RegisterController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getRegister() {
        return view('auth/register');
    }

    public function register(userRegisterRequest $userRegisterRequest) {
        // dd($userRegisterRequest);
        $user = $this->userRepository->register($userRegisterRequest);
        if ($user) {
            return redirect()->route('user_login')->with('success', 'Registered successfully');
        }
    }
}
