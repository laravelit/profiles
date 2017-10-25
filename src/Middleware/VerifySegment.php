<?php

namespace Laravelit\Profiles\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Laravelit\Profiles\Exceptions\SegmentDeniedException;

class VerifySegment
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
     * @param int|string $segment
     * @return mixed
     * @throws \Laravelit\Profiles\Exceptions\SegmentDeniedException
     */
    public function handle($request, Closure $next, $segment)
    {
        if ($this->auth->check() && $this->auth->user()->can($segment)) {
            return $next($request);
        }

        throw new SegmentDeniedException($segment);
    }
}
