<?php

namespace App\Repositories;

interface UserRepositoryInterface 
{
    public function register($request);

    public function login($request);

    public function list();

    public function delete($id);
}