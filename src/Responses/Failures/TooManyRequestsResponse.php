<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 429 Too Many Requests responses.
 */
class TooManyRequestsResponse extends FailureResponse
{
    /**
     * Create a new too many requests response instance.
     *
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $errors  Optional structured error details.
     */
    public function __construct(string $message, array|JsonResource $errors = [])
    {
        parent::__construct(JsonResponse::HTTP_TOO_MANY_REQUESTS, $message, $errors);
    }
}
