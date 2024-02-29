<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFields(['name', 'email'])
            ->allowedFilters(['name', 'email'])
            ->allowedSorts(['name', 'email'])
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

        try{
            DB::beginTransaction();
            $user = User::create($validated);

            $role = new Role([
                    'account_id' => $user->account_id,
                    'role_name' => 'reader',
            ]);
            $user->role()->save($role);

             DB::commit();

            return new UserResource($user);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'User creation failed.'], 500);
        }

        
        
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
