<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFields(['full_name', 'email'])
            ->allowedFilters(['full_name', 'email'])
            ->allowedSorts(['full_name', 'email'])
            ->allowedIncludes(['roles'])
            ->defaultSort('created_at')
            ->paginate();

        return new UserCollection($users);
    }

    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        
        return response()->noContent();
    }
}
