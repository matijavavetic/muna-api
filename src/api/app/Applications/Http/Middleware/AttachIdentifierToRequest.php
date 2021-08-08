<?php

namespace src\Applications\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class AttachIdentifierToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $input = $request->all();
        $userUuid = '';

        if (! $request->cookie('user_id')) {
            $userUuid = Uuid::uuid4()->toString();
            Cookie::queue('user_id', $userUuid);
        } else {
            $userUuid = $request->cookie('user_id');
        }

        $input['userId'] = $userUuid;

        $request->replace($input);
        
        return $next($request);
    }
}
