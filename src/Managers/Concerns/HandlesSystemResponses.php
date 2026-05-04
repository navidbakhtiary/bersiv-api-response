<?php

namespace NBDev\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handles system-level facade responses.
 */
trait HandlesSystemResponses
{
    /**
     * Return a default internal server error response.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function serverError(array|JsonResource $errors = []): JsonResponse
    {
        return $this->system_response_action->serverError($errors);
    }
}
