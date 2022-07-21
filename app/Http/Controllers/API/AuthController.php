<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
// use Illuminate\Validation\Validator;

class AuthController extends Controller
{

    // controller register
    public function register(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3'
        ]);

        // $validator = Validator::make($request->all(),[
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:3'
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors());       
        // }

        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Account has been created successfully'], 200);
    }

    public function login(Request $request) {

        // ambil data user dari model User, dimana email sama dengan inputan email ($request->email)
        $user = User::where('email', $request->email)->first();
        // dd($user);
        
        // kondisi jika ga ada data user yg diinginkan, 
        // dan hasil hasing password yg dimasukan tidak sama dengan hashing password di db pake Hash::check
        //
        if (!$user || !Hash::check($request->password, $user->password) ) {
            // return "gagal";
            return response()->json([
                'message'=>'Password atau Email salah!',
            ], 401);
        }

        $token = $user->createToken('token_name')->plainTextToken;

        return response()->json([
                'message'=>'Success!',
                'data'=> [
                    'user'=>$user,
                    'token' => $token
                ]
         ], 200);
    }

    public function logout(Request $request) {

        // cek dahulu siapa sedang login

        // $user = $request->user();

        // menghapus token untuk user yg baru aja otentikasi
       $request->user()->currentAccessToken()->delete();

       return response()->json([
                'message'=>'Berhasil logout!'
         ], 200);
    }
}
