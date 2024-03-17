<?php

namespace App\Http\Controllers\Candidate;

use Exception;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Models\Candidate\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

class CandidateLoginController extends Controller {
    public function candidateSignup( Request $request ) {

        try {
            $request->validate( [
                'firstname' => 'required|string',
                'lastname'  => 'required|string',
                'email'     => 'required|email|unique:candidates,email',
                'password'  => 'required|confirmed|min:6',
            ] );

            $data = Candidate::create( [
                'firstname' => $request->input( 'firstname' ),
                'lastname'  => $request->input( 'lastname' ),
                'email'     => $request->input( 'email' ),
                'password'  => $request->input( 'password' ),
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Sign up completed.', 'data' => $data] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function candidateLogin( Request $request ) {

        try {

            $request->validate( [
                'email'    => 'required|email',
                'password' => 'required',
            ] );

            $user = Candidate::where( 'email', $request->input( 'email' ) )->first();

            $userID = $user->id;

            if ( !$user || $request->input( 'password' ) !== $user->password ) {

                return response()->json( ['status' => "failed", 'message' => "Invaild User Or Wrong Password!"] );

            } else {

                $token = JWTToken::createToken( $userID, $request->input( 'email' ) );

                return response()->json( ['status' => "success", 'message' => "Login Successfull", "user" => $user, 'token' => $token] )->cookie( 'token', $token, time() + 60 * 60 * 24 );
            }

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function allCandidate(Request $request){

        $email = $request->header('email');
        $result = Candidate::where('email',$email)->count();

        return $result;
    }


    public function  candidateLogout(Request $request){

        return redirect('/')->withCookie(Cookie::forget('token'));

    }

    public function sendOTP( Request $request ) {

        $email = $request->input( 'email' );
        $otpCode = rand( 1000, 9999 );

        $user = Candidate::where( 'email', $email )->count();

        if ( $user == 1 ) {

            Candidate::where( 'email', $email )->update( ['otp' => $otpCode] );

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

            $user = Candidate::where( 'email', '=', $email )->where( 'otp', '=', $otpCode )->first();

            if ( !$user || $otpCode != $user->otp ) {

                return response()->json( ['status' => 'failed', 'message' => 'OTP did not matched!'] );

            } else {

                $userID = $user->id;

                Candidate::where( 'email', $email )->update( ['otp' => '0'] );

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
                'password' => 'required|confirmed|min:6',
            ] );

            $email = $request->header( 'email' );
            $password = $request->input( 'password' );

            Candidate::where( 'email', $email )->update( ['password' => $password] );

            return response()->json( ['status' => 'success', 'message' => 'Password reset successfully', 'email' => $email] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
}
