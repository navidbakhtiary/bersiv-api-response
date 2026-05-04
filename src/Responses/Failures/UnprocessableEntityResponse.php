<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 422 Unprocessable Entity responses.
 *
 * This response should be used when the request structure is valid,
 * but the provided input cannot be processed because it violates
 * validation or domain rules.
 */
class UnprocessableEntityResponse extends FailureResponse
{
    /**
     * Create a new unprocessable entity response instance.
     *
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $errors  Optional structured error details.
     */
    public function __construct(string $message, array|JsonResource $errors = [])
    {
        parent::__construct(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $message, $errors);
    }
}
