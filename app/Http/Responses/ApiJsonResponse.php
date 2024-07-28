<?php
declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Enums\StatusCodeEnum;
use stdClass;

readonly class ApiJsonResponse implements Responsable
{
    /**
     * @param int $httpCode
     * @param bool $status
     * @param string $message
     * @param object|array $data
     */
    public function __construct(
        public int          $httpCode = StatusCodeEnum::SUCCESS->value,
        public bool         $status = true,
        public string       $message = "",
        public object|array $data = new stdClass(),
    )
    {
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            [
                "status" => $this->status,
                "message" => $this->message,
                "data" => $this->data
            ],
            $this->httpCode
        );
    }
}
