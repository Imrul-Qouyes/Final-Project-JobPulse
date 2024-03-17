<?php

namespace App\Http\Controllers\JobserviceOwner;

use Exception;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\JobserviceOwner\JobserviceOwner;

class JobserviceOwnerLoginController extends Controller {
    public function jobserviceOwnerLogin( Request $request ) {

        try {
            $request->validate( [
                'email'    => 'required|email|max:50',
                'password' => 'required|string|max:50',
            ] );

            $user = JobserviceOwner::where( 'email', $request->input( 'email' ) )->first();
            $userID = $user->id;
            $userEmail = $user->email;
            

            if ( !$user || ( $request->input( 'password' ) != $user->password ) ) {

                return response()->json( ['status' => 'failed', 'message' => 'Invalid User or Password'] );

            } else {

                $token = JWTToken::createToken( $userID, $userEmail );

                return response()->json( ['status' => 'success', 'message' => 'Login Successfull', 'user' => $user] )->cookie( 'token', $token, time() + 60 * 60 * 7 );

            }
        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function  jobserviceOwnerLogout(Request $request){

        return redirect('/login/jobserviceOwner')->withCookie(Cookie::forget('token'));;

    }

    public function sendOTP( Request $request ) {

        $email = $request->input( 'email' );
        $otpCode = rand( 1000, 9999 );

        $user = JobserviceOwner::where( 'email', $email )->count();

        if ( $user == 1 ) {

            JobserviceOwner::where( 'email', $email )->update( ['otp' => $otpCode] );

            Mail::to( $email )->send( new OTPMail( $otpCode ) );

            return response()->json( ['status' => 'success', 'message' => '4 digit pin has been sent to your mail'] );

        } else {

            return response()->json( ['status' => 'failed', 'message' => 'unauthorized'] );
        }

    }

    public function verifyOTP( Request $request ) {

        try {

            $email = $request->input( 'email' );
            $otpCode = $request->input( 'otp' );

            $request->validate( [
                'otp' => 'required|min:4',
            ] );

            $user = JobserviceOwner::where( 'email', '=', $email )->where( 'otp', '=', $otpCode )->first();

            if ( !$user || $otpCode != $user->otp ) {

                return response()->json( ['status' => 'failed', 'message' => 'OTP did not matched!'] );

            } else {

                $userID = $user->id;

                JobserviceOwner::where( 'email', $email )->update( ['otp' => '0'] );

                $token = JWTToken::createTokenForSetPassword( $userID, $email );

                return response()->json( ['status' => 'success', 'message' => 'OTP Verification Successfull'] )->cookie( 'token', $token, time() + 60 * 5 );
            }

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }

    }

    public function resetPassword( Request $request ) {

        try {
            $request->validate( [
                'password' => 'required|min:6',
            ] );

            $email = $request->header( 'email' );
            $password = $request->input( 'password' );

            JobserviceOwner::where( 'email', $email )->update( ['password' => $password] );

            return response()->json( ['status' => 'success', 'message' => 'Password reset successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
}
