<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function createToken( $userId, $userEmail ) {

        $key = env( 'JWT_KEY' );

        $payload = [
            'iss'       => 'jobpulse.com',
            'iat'       => time(),
            'exp'       => time() + 60 * 60 * 24 * 3,
            'userId'    => $userId,
            'userEmail' => $userEmail,
        ];

        return JWT::encode( $payload, $key, 'HS256' );
    }


    public static function createTokenForSetPassword( $userID, $userEmail ) {

        $key = env( 'JWT_KEY' );

        $payload = [
            'iss'       => 'jobpulse.com',
            'iat'       => time(),
            'exp'       => time() + 60 * 5,
            'userId' => $userID,
            'userEmail' => $userEmail,
        ];

        return JWT::encode( $payload, $key, 'HS256' );
    }



    public static function verifyToken( $token ) {

        try {
            if ( $token == null ) {
                return "unauthorized";
            } else {
                $key = env( 'JWT_KEY' );
                return JWT::decode( $token, new Key( $key, 'HS256' ) );

            }
        } catch ( Exception $exception ) {

            return "unauthorized";
        }

    }
}