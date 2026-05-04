<?php

namespace NBDev\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HandlesExternalApiResponses
{
    /**
     * Return a response when the external API rejects the request.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function externalApiRejected(array|JsonResource $errors = []): JsonResponse
    {
        return $this->external_api_response_action->rejected($errors);
    }

    /**
     * Return a response when the external API is unavailable.
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function externalApiUnavailable(array|JsonResource $errors = []): JsonResponse
    {
        return $this->external_api_response_action->unavailable($errors);
    }
}
