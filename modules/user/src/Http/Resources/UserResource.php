<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Enums\TokenTypeEnum;

class UserResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     * @param string|null $token
     */
    public function __construct(
        $resource,
        protected string|null $token = null,
    )
    {
        parent::__construct($resource);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_admin' => (bool) $this->is_admin,
            'token' => [
                'token' => $this->token,
                'type' => TokenTypeEnum::BEARER->value,
                'connection_token' => $this->connectionToken->token,
            ]
        ];
    }
}
