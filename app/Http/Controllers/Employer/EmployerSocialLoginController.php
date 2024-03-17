<?php

namespace App\Http\Controllers\Employer;

use App\Helper\JWTToken;
use App\Models\Employer\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class EmployerSocialLoginController extends Controller {

    public function googleRedirect() {

        return Socialite::driver( 'google' )->redirect();

    }

    public function googleCallback() {

        $user = Socialite::driver( 'google' )->user();

        $findUser = Employer::where( 'google_id', $user->id )->first();

        $userID = $findUser->id;
        $userEmail = $findUser->email;
        dd($user);
        if ( $findUser ) {

            $token = JWTToken::createToken( $userID, $userEmail );
            Auth::login($findUser);
            
            return response()->json( ['status' => 'success', 'message' => 'Login successfull'] )->cookie( 'token', $token, time() + 60 * 60 );
            
        } else {

            $newUser = Employer::create( [
                'firstname' => $user->name,
                'email'     => $user->email,
                'google_id' => $user->id,
            ] );
            Auth::login($newUser);

            return route('page.blog');
        }
    }
}
