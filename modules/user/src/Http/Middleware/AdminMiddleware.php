<?php

namespace Modules\User\Http\Middleware;

use App\Http\Responses\ApiJsonResponse;
use Closure;
use Illuminate\Http\Request;
use Modules\Auth\Enums\StatusCodeEnum;

class AdminMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->is_admin) {
            return $next($request);
        }

        return new ApiJsonResponse(
            httpCode: StatusCodeEnum::FORBIDDEN->value,
            status: false,
            message: 'Access denied',
        );
    }
}
