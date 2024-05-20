<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|email',
            "username" => 'required|min:3',
            "password" => 'required',
            "confirm_password" => 'required|same:password'
        ]);

    if ($validate->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal Registrasi',
            'data' => $validate->errors()
        ]);
    }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Berhasil',
            'data' => $success
        ]);
    }

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken['auth_token']->plainTextToken;
            $success['name'] = $auth->name;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil!',
                'data' => $success
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal!',
                'data' => null
            ]);
        }
    }
}
