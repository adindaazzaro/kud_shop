<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MPelanggan;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Helper;
    public function register(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8'
            ]);

            if($validator->fails()){
                return response()->json($this->responseData(null,$validator->errors(),500));
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            $data = ['user' => $user,'access_token' => $token, 'token_type' => 'Bearer'];
            return response()->json($this->responseData($data));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }

    public function login(Request $request)
    {

        try{
            if (!Auth::guard('pelanggan')->attempt($request->only('email', 'password')))
            {
                return response()->json($this->responseData(null,'Email atau Password Salah',200));
            }

            $user = MPelanggan::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;
            $data = ['message' => 'Hi ' . $user->nama . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer'];
            return response()->json($this->responseData($data));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));

        }

    }
    public function profile(Request $request)
    {
        try{
            return response()->json($this->responseData($request->user()));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
    // method for user logout and delete token
    public function logout()
    {

        try{
            auth()->user()->tokens()->delete();
            return response()->json($this->responseData(null,'You have successfully logged out and the token was successfully deleted'));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
}
