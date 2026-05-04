<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 403 Forbidden responses.
 *
 * This response should be used when the request is understood
 * but the client is not allowed to proceed.
 */
class ForbiddenResponse extends FailureResponse
{
    /**
     * Create a new forbidden response instance.
     *
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $errors  Optional structured error details.
     */
    public function __construct(string $message, array|JsonResource $errors = [])
    {
        parent::__construct(JsonResponse::HTTP_FORBIDDEN, $message, $errors);
    }
}
