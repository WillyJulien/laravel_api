<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware {
    /**
    * Determine the path to redirect the user when not authenticated.
    *
    * For JSON requests, returns null to avoid redirection.
    * For web applications, redirects to the login route.
    *
    * @param \Illuminate\Http\Request $request
    * @return string|null
    */
    protected function redirectTo( Request $request ): ?string {
        // Return null to prevent redirection for JSON requests
        if ( $request->expectsJson() ) {
            return null;
        }

        // Redirect to the login route for web requests
        return route( 'login' );
    }

    /**
    * Handle an unauthenticated user by returning a JSON response.
    *
    * Returns a 401 Unauthorized JSON response for failed authentication.
    *
    * @param \Illuminate\Http\Request $request
    * @param array $guards
    * @return void
    */
    protected function unauthenticated( $request, array $guards ) {
        // Return a JSON response with a 401 Unauthorized status
        abort( response()->json( [ 'message' => 'Unauthorized' ], 401 ) );
    }
}
