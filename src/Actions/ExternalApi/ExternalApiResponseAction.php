<?php

namespace NBDev\BersivApiResponse\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NBDev\BersivApiResponse\Responses\Failures\BadGatewayResponse;
use NBDev\BersivApiResponse\Responses\Failures\ServiceUnavailableResponse;

/**
 * Handles responses related to external API interactions.
 *
 * This action is intended for cases where the application communicates
 * with third-party services and needs to return a clear failure response
 * based on the type of upstream problem.
 *
 * Response behavior:
 * - returns 502 Bad Gateway when the external API rejects the request
 * - returns 503 Service Unavailable when the external API is unavailable
 */
class ExternalApiResponseAction
{
    /**
     * Return a response when the external API rejects the request.
     *
     * Common cases:
     * - upstream validation failure
     * - upstream business-rule rejection
     * - malformed request accepted by this app but rejected upstream
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function rejected(array|JsonResource $errors = []): JsonResponse
    {
        return (
            new BadGatewayResponse(
                __('bersiv-api-response::messages.failures.external_api_rejected'),
                $errors
            )
        )->send();
    }

    /**
     * Return a response when the external API is unavailable.
     *
     * Common cases:
     * - timeout
     * - connection failure
     * - upstream downtime
     * - temporary service outage
     *
     * @param  array|JsonResource  $errors  Optional structured error details.
     * @return JsonResponse The formatted JSON response.
     */
    public function unavailable(array|JsonResource $errors = []): JsonResponse
    {
        return (
            new ServiceUnavailableResponse(
                __('bersiv-api-response::messages.failures.unavailable_external_api'),
                $errors
            )
        )->send();
    }
}
