<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class UserUsersController extends Controller
{
    public function index(Request $request, User $user): UserCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $users = $user
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, User $user): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'points' => ['required', 'numeric'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $user->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
