<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;
use Closure;

class roleMiddleware
{

      /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $role;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->role = $auth->user()->role;
    }

    public function handle($request, Closure $next, $role)//passing extra parameter role
    {
        if($this->role != $role)//come role parameter from route which we given like admin
        {
               return response()->json(['message'=>"You are not Allowed to access this route this is for admin","status"=>401]);
        }
        return $next($request);
    }
}
