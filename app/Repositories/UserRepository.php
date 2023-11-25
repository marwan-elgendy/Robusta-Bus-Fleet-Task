<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
        return UserResource::make($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function createAdmin(array $data)
    {
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'is_admin'=>true,
        ]);
        return UserResource::make($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function find($id)
    {
        $user = User::find($id);
        if($user){
            return UserResource::make($user);
        }
        return null;
    }

    /**
     * @param array $data
     * @return User
     */
    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return UserResource::make($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function findByName($name)
    {
        $user = User::where('name', $name)->first();
        return UserResource::make($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function findByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return UserResource::make($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function all(){
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * @param array $data
     * @return User
     */
    public function paginate($page, $perPage){
        $users = User::paginate($perPage, ['*'], 'page', $page);
        return UserResource::collection($users)->response()->getData(true);
    }
}
