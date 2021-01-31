<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepositories;

    public function __construct(UserRepositories $userRepositories)
    {
        $this->userRepositories = $userRepositories;
    }

    public function index()
    {
        $users = $this->userRepositories->all();

        return response()->json($users);
    }

    public function show(int $id)
    {
        $user = $this->userRepositories->get($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User($request->all());
        $user = $this->userRepositories->save($user);

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user = $this->userRepositories->save($user);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user = $this->userRepositories->delete($user);

        return response()->json($user);
    }

    public function getWithSameFirstAndLastName()
    {
        $name = request()->get('name');

        /*
         * Logica de negocio
         * ...
         * ...
         */

        $users = $this->userRepositories->getWithSameFirstAndLastName($name);

        return response()->json($users);
    }
}
