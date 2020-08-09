<?php

namespace App\Http\Middleware;

use App\Repositories\User\UserRepositoryInterface;
use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JwtAuth
{

    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        $cleanToken = str_replace("Bearer ", "",$token);

        if(!$cleanToken) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Authorization token not provided.',
                'error_code' => '1001',
            ], 401);
        }


        try {
            $credentials = JWT::decode($cleanToken, config('o2o.jwt_token'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }

        $user = $this->repository->getDataById($credentials->sub);

        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;

        return $next($request);
    }
}
