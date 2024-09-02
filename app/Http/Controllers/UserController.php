<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        try {
            $user = User::all();
            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (User::where('email', $request->email)->exists()) {
                return response()->json(['message' => 'email sudah terdaftar'], 404);
            } else {
                $userx = new User();
                $userx->email = $request->email;
                $userx->password = Hash::make($request->password);
                $userx->nama = $request->nama;
                $userx->alamat = $request->alamat;
                $userx->telp = $request->telp;
                $userx->jenisKelamin = $request->jenisKelamin;
                $userx->save();
                return response()->json(['message' => 'data berhasil ditambahkan'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!empty($user)) {
                return response()->json($user);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (User::where('id', $id)->exists()) {
                $user = User::find($id);
                $user->email = is_null($request->email) ? $user->email : $request->email;
                $user->password = is_null($request->password) ? $user->password : Hash::make($request->password);
                $user->nama = is_null($request->nama) ? $user->nama : $request->nama;
                $user->alamat = is_null($request->alamat) ? $user->alamat : $request->alamat;
                $user->telp = is_null($request->telp) ? $user->telp : $request->telp;
                $user->jenisKelamin = is_null($request->jenisKelamin) ? $user->jenisKelamin : $request->jenisKelamin;
                $user->save();
                return response()->json(['message' => 'data berhasil diubah'], 200);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (User::where('id', $id)->exists()) {
                $user = User::find($id);
                $user->delete();
                return response()->json(['message' => 'data berhasil dihapus'], 200);
            } else {
                return response()->json(['message' => 'data tidak ditemukan'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'type' => 'Bearer'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
