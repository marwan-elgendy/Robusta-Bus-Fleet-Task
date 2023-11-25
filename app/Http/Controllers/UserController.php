<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $page
     * show all users or paginate
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $page = request()->query('page') ?? '1';
        if($page == '*'){
            $users = $this->userRepository->all();
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        }
        $users = $this->userRepository->paginate($page, 3);
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'User successfully created',
            'data' => $user
        ], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByName($name)
    {
        $user = $this->userRepository->findByName($name);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }
    
    /**
     * @param string $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByEmail($email)
    {
        $user = $this->userRepository->findByEmail($email);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->update($request->all(), $id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user could not be updated'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'User successfully updated',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->delete($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user could not be deleted'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'User successfully deleted',
            'data' => $user
        ], 200);
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAdmin(UserCreateRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, admin user could not be created'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Admin user successfully created',
            'data' => $user
        ], 201);
    }

}
