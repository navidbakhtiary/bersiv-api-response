<?php

namespace NBDev\BersivApiResponse\Responses\Successes;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents successful 202 Accepted responses.
 *
 * This response is useful when a request has been accepted for processing,
 * but the final result is not available immediately.
 */
class AcceptedResponse extends SuccessResponse
{
    /**
     * Create a new accepted response instance.
     *
     * @param  string  $message  The response message.
     * @param  array|JsonResource  $data  Optional response payload.
     */
    public function __construct(string $message, array|JsonResource $data = [])
    {
        parent::__construct(JsonResponse::HTTP_ACCEPTED, $message, $data);
    }
}
