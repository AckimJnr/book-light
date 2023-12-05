<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validated) ){
            return response()->json([
                'message'=> 'Login information invalid',
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);


        
        try{
            DB::beginTransaction();
            $user = User::create($validated);

            $role = new Role([
                    'account_id' => $user->account_id,
                    'role_name' => 'reader',
            ]);
            $user->role()->save($role);

             DB::commit();

             return response()->json([
                'data' => $user,
                'access_token' => $user->createToken('api_token')->plainTextToken,
                'token_type' => 'Bearer'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Registration failed.'], 500);
        }


    }

    public function login_view()
    {
        return view('authentication.login');
    }

    public function register_view()
    {
        return view('authentication.register');
    }
}
