<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\ExternalApi;

use Illuminate\Http\JsonResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\BadGatewayResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\ServiceUnavailableResponse;

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
	 * @param string|null $message Optional custom message.
	 * @param array $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function rejected(?string $message = null, array $errors = []): JsonResponse
	{
		return BadGatewayResponse::externalApiRejected($message, $errors);
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
	 * @return JsonResponse The formatted JSON response.
	 */
	public function unavailable(): JsonResponse
	{
		return ServiceUnavailableResponse::externalApiUnavailable();
	}
}
