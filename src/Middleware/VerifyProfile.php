<?php

namespace Laravelit\Profiles\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Laravelit\Profiles\Exceptions\ProfileDeniedException;

class VerifyProfile
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int|string $profile
     * @return mixed
     * @throws \Laravelit\Profiles\Exceptions\ProfileDeniedException
     */
    public function handle($request, Closure $next, $profile)
    {
        if ($this->auth->check() && $this->auth->user()->is($profile)) {
            return $next($request);
        }

        throw new ProfileDeniedException($profile);
    }
}
