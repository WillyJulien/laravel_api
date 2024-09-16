<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Enums\ProfileStatus;
use Laravel\Sanctum\PersonalAccessToken;

class ProfileController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index( Request $request ) {

        // Extract the token from the Authorization header
        $token = $request->bearerToken();

        if ( $token ) {
            // Find the token and associated user
            $accessToken = PersonalAccessToken::findToken( $token );

            if ( $accessToken ) {
                // Authenticate the user
                $user = $accessToken->tokenable;

                // Retrieve all active profiles
                $profiles = Profile::where( 'status', ProfileStatus::Active->value )->get();

                // If the user is authenticated, return all fields
                return response()->json( $profiles );
            }
        }

        // Else Retrieve all active profiles
        $profiles = Profile::where( 'status', ProfileStatus::Active->value )->get();

        // Exclude the 'status' field for unauthenticated users
        $profiles = $profiles->makeHidden( 'status' );
        return response()->json( $profiles );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( ProfileRequest $request ) {

        try {
            // Create a new profile with after the ProfileRequest
            $profile = Profile::create( [
                'name' => $request->input( 'name' ),
                'firstname' => $request->input( 'firstname' ),
                'image' => $request->input( 'image' ),
                'status' => $request->input( 'status' ),
            ] );

            // Return a response with the created profile and a success message
            return response()->json( [ 'message' => 'Profile created successfully', 'profile' => $profile ], 201 );

        } catch ( \Exception $e ) {
            // In case of error, return an error response with a message
            return response()->json( [ 'message' => 'Failed to create profile', 'error' => $e->getMessage() ], 500 );
        }

    }

    /**
    * Display the specified resource.
    */

    public function show( Profile $profile ) {
        // return  model.
        return response()->json( $profile );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( ProfileRequest $request, Profile $profile ) {

        // Update specified fields
        $profile->update( $request->only( [ 'name', 'firstname', 'image', 'status' ] ) );
        // image is nullable

        return response()->json( [ 'message' => 'Profile updated successfully', 'profile' => $profile ], 200 );

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Profile $profile ) {
        try {
            // Attempt to delete the profile
            if ( $profile->delete() ) {
                // If deletion is successful, return a success message
                return response()->json( [ 'message' => 'Profile deleted successfully' ], 200 );
            } else {
                // If deletion fails, return an error message
                return response()->json( [ 'message' => 'Failed to delete profile' ], 500 );
            }
        } catch ( \Exception $e ) {
            // In case of an unexpected error, return an error response
            return response()->json( [ 'message' => 'An error occurred while trying to delete the profile', 'error' => $e->getMessage() ], 500 );
        }

    }
}