<?php

namespace NBDev\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 404 Not Found responses.
 */
class NotFoundResponse extends FailureResponse
{
    /**
     * Create a new not found response instance.
     *
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $errors  Optional structured error details.
     */
    public function __construct(string $message, array|JsonResource $errors = [])
    {
        parent::__construct(JsonResponse::HTTP_NOT_FOUND, $message, $errors);
    }
}
