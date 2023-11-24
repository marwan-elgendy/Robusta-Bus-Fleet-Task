<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
    }
}
