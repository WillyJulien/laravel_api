<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    /**
    * Authenticate an administrator and return a token if successful.
    *
    * Validates login credentials ( email and password ). If valid, generates
    * a Sanctum token for the administrator. Otherwise, returns a 401 error.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function login(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ], 422);
        }

        // Retrieve admin by email
        $admin = Administrator::where('email', $request->email)->first();

        // Check admin existence and password validity
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([ 'message' => 'Authentication failed' ], 401);
        }

        // Generate and return Sanctum token
        $token = $admin->createToken('admin-token')->plainTextToken;
        return response()->json([ 'token' => $token ]);
    }

    /**
    * Log out the current administrator by deleting their token.
    *
    * Deletes the current access token of the logged-in administrator
    * and returns a success message.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([ 'message' => 'Logged out successfully' ], 200);
    }

}
