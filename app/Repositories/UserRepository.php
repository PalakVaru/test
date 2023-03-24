<?php

namespace App\Repositories;
use App\Models\User;
use Hash;
use Auth;

class UserRepository implements UserRepositoryInterface  
{
    public function register($request) {
        $request->password = Hash::make($request->password);
        
        if($request->hasFile('photo')){
            $filename = $request->photo->getClientOriginalName();
            $request->photo->storeAs('images',$filename,'public');
        }

        return User::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'photo' => $filename
        ]);
    }

    public function login($request) {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function list() {
        return User::get();
    }

    public function delete($id) {
        return User::findorfail($id)->delete();
    }
}