<?php



namespace App\Http\Middleware;



use Closure;

use JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;



class JwtMiddleware extends BaseMiddleware

{



    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)

    {

		//$headers = apache_request_headers(); //get header

        //print_r($headers);exit;
        
           

        //    $headers = apache_request_headers(); //get header
        //    $request->header('Authorization', $request->input('token'));

        // $request->header('Authorization','Bearer '.$request->input('token'));

		
        //    return response()->json(['headers' =>  $request->header()]);



        //JWTAuth::setToken($request->input('token'));

        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return response()->json(['status' => 'Token is Invalid']);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return response()->json(['status' => 'Token is Expired']);

            }else{

                return response()->json(['status' => 'Authorization Token not found']);

            }

        }

        return $next($request);

    }

}

