<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiJsonResponse;
use Illuminate\Http\Request;
use Modules\User\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return ApiJsonResponse
     * @response UserResource
     */
    public function __invoke(Request $request)
    {
        return new ApiJsonResponse(
            data: UserResource::make($request->user())
        );
    }
}
