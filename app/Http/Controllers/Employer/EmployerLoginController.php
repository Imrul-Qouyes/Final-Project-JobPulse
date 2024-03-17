<?php

namespace App\Http\Controllers\Employer;

use Exception;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Models\Employer\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\Employer\EmployerDetail;

class EmployerLoginController extends Controller {
    public function employerSignup( Request $request ) {

        try {
            $request->validate( [
                'firstname' => 'required|string',
                'lastname'  => 'required|string',
                'email'     => 'required|email|unique:employers,email',
                'password'  => 'required|confirmed|min:6',
            ] );

            $data = Employer::create( [
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

    public function employerLogin( Request $request ) {

        try {

            $request->validate( [
                'email'    => 'required|email',
                'password' => 'required',
            ] );

            $user = Employer::where( 'email', $request->input( 'email' ) )->first();

            $userID = $user->id;

            if ( !$user || $request->input( 'password' ) !== $user->password || $user->status == 'pending' ) {

                return response()->json( ['status' => "failed", 'message' => "Invaild User Or Wrong Password!"] );

            } else {

                $token = JWTToken::createToken( $userID, $request->input( 'email' ) );

                return response()->json( ['status' => "success", 'message' => "Login Successfull", "user" => $user, "token" => $token] )->cookie( 'token', $token, time() + 60 * 60 * 24 );

            }

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function employerDetails( Request $request ) {

        try {
            $request->validate( [
                'company_name'              => 'required|string',
                'company_address'           => 'required',
                'company_size'              => 'required|string',
                'company_type'              => 'required|string',
                'business_description'      => 'required',
                'contactPerson_name'        => 'required|string',
                'contactPerson_email'       => 'required|email',
                'contactPerson_designation' => 'required|string',
                'company_establishYear'     => 'required|string',
                'employer_id'               => 'required',
            ] );

            EmployerDetail::create( $request->all() );

            return response()->json( ['status' => 'success', 'message' => 'Submited Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function sendOTP( Request $request ) {

        $email = $request->input( 'email' );
        $otpCode = rand( 1000, 9999 );

        $user = Employer::where( 'email', $email )->count();

        if ( $user == 1 ) {

            Employer::where( 'email', $email )->update( ['otp' => $otpCode] );
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

            $user = Employer::where( 'email', '=', $email )->where( 'otp', '=', $otpCode )->first();

            if ( !$user || $otpCode != $user->otp ) {

                return response()->json( ['status' => 'failed', 'message' => 'OTP did not matched!'] );

            } else {

                $userID = $user->id;

                Employer::where( 'email', $email )->update( ['otp' => '0'] );

                $token = JWTToken::createTokenForSetPassword( $userID, $email );

                return response()->json( ['status' => 'success', 'message' => 'OTP Verification Successfull'] )->cookie( 'token', $token, time() + 60 * 60 * 5 );
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

            Employer::where( 'email', '=', $email )->update( ['password' => $password] );

            return response()->json( ['status' => 'success', 'message' => 'Password reset successfully', 'email' => $email] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function  Logout(Request $request){

        return redirect('/')->withCookie(Cookie::forget('token'));

    }

    public function allEmployer(Request $request){
        
        $email = $request->header('email');
        $result = Employer::where('email',$email)->count();

        return $result;
    }
}
