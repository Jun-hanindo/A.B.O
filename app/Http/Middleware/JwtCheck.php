<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use App\Models\API\v1\User;

class JwtCheck extends BaseMiddleware
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

        if (! $token = $this->auth->setRequest($request)->getToken()) {
            $status = array('code'=>500,
                'message'=>trans('general.token_not_provided'),
                'status'=>'error',
                'data'=>array()
            );
            return response()->json(array('error'=>$status),200);
        }

        try {
            
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            $status = array('code'=>500,
                'message'=>trans('general.token_expired'),
                'status'=>'error',
                'data'=>array()
            );
            return response()->json(array('error'=>$status),200);
        } catch (JWTException $e) {
            $status = array('code'=>500,
                'message'=>trans('general.token_invalid'),
                'status'=>'error',
                'data'=>array()
            );
            return response()->json(array('error'=>$status),200);
            
        }

        if (! $user) {
            $status = array('code'=>500,
                'message'=>trans('general.user_not_found'),
                'status'=>'error',
                'data'=>array()
            );
            return response()->json(array('error'=>$status),200);
            
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}