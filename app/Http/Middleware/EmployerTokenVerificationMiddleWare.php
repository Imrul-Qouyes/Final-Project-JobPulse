<?php

namespace App\Http\Middleware;

use App\Models\Employer\Employer;
use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployerTokenVerificationMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $token = $request->cookie( 'token' );
    
        $result = JWTToken::verifyToken( $token );

        $count = Employer::where('email',$result->userEmail)->count();        
        
        
        if($count == 0){

            return redirect('/');

        }else{

            $request->headers->set( 'email', $result->userEmail );
            $request->headers->set( 'id', $result->userId );
        }
        

        return $next( $request );
    
    }
}
