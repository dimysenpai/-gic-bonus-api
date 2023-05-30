<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUser $request)
    {
        try {
            $user = new User();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password, [
                'rounds' => 12
            ]);

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'l\'utilisateur est enregistrer',
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function login(LoginUser $request)
    {
        try {
            $auth = auth()->attempt($request->only(['email', 'password']));
            if ($auth) {
                $user = auth()->user();
                $tokenKey = 'GIC_BONUS_DIMI_SENPAI_DEV_API';

                $token = Hash::make($tokenKey . $user->id);

                // $token = $user->createToken($tokenKey)->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'l\'utilisateur est connecté',
                    'user' => $user,
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'cette utilisateur n\'existe pas'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function listUser(Request $request)
    {
        try {
            $query = User::query();
            $perPage = 10;
            $page = $request->input('page', 1);
            $search = $request->input('search');

            if ($search) {
                $query->whereRaw("username LIKE '%" . $search . "%'");
            }

            $total = $query->count();

            $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Tous les utilisateurs',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'items' => $result
            ]);
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        try {

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'utilisateur modifier',
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'utilisateur supprimer',
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }
}
