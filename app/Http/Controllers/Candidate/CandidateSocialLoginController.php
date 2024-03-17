<?php

namespace App\Http\Controllers\Candidate;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\Candidate\Candidate;
use Laravel\Socialite\Facades\Socialite;

class CandidateSocialLoginController extends Controller {

    public function googleRedirect() {

        return Socialite::driver( 'google' )->redirect();

    }

    public function googleCallback() {

        $user = Socialite::driver( 'google' )->user();

        $findUser = Candidate::where( 'google_id', $user->id )->first();

        $userID = $findUser->id;
        $userEmail = $findUser->email;

        if ( $findUser ) {

            $token = JWTToken::createToken( $userID, $userEmail );

            return response()->json( ['status' => 'success', 'message' => 'Login successfull'] )->cookie( 'token', $token, time() + 60 * 60 );
            
        } else {

            $newUser = Candidate::create( [
                'firstname' => $user->name,
                'email'     => $user->email,
                'google_id' => $user->id,
            ] );

            return response()->json( $newUser );
        }
    }
}
