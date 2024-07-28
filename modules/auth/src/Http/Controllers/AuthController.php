<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiJsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Enums\StatusCodeEnum;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Models\ConnectionToken;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Models\User;
use Opekunov\Centrifugo\Centrifugo;

class AuthController extends Controller
{
    /**
     * @param Centrifugo $centrifugo
     */
    public function __construct(
        protected Centrifugo $centrifugo,
    )
    {
    }

    /**
     * @param LoginRequest $request
     * @return ApiJsonResponse
     * @response UserResource
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        if (!\Auth::attempt($request->only(['email', 'password']))) {
            return new ApiJsonResponse(
                httpCode: StatusCodeEnum::UNAUTHORIZED->value,
                status: false,
                message: 'Unauthorized',
            );
        }

        $user = \Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->saveConnectionToken($user);

        return new ApiJsonResponse(
            data: UserResource::make($user, $token),
        );
    }

    /**
     * @param RegisterRequest $request
     * @return ApiJsonResponse
     * @response UserResource
     * @unauthenticated
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->saveConnectionToken($user);

        return new ApiJsonResponse(
            data: UserResource::make($user, $token),
        );
    }

    /**
     * @param Request $request
     * @return ApiJsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return new ApiJsonResponse(
            message: 'Logout successfully',
        );
    }

    /**
     * @param User $user
     * @return void
     */
    protected function saveConnectionToken(User $user): void
    {
        $exp = now()->addDays(3);
        $connectionToken = $this->centrifugo->generateConnectionToken($user->id, $exp, ['role' => 'user', ['public', 'private']]);

        ConnectionToken::updateOrCreate(['user_id' => $user->id], ['user_id' => $user->id, 'token' => $connectionToken, 'expired_at' => $exp]);
    }
}
