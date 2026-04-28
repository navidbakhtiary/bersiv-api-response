<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\RateLimit;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\TooManyRequestsResponse;

/**
 * Handles rate-limit-related failure responses.
 *
 * This action is intended for requests blocked because too many requests
 * were sent in a short period of time.
 */
class RateLimitResponseAction
{
	/**
	 * Return a default too many requests response.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function tooManyRequests(array|JsonResource $errors = []): JsonResponse
	{
		return (
			new TooManyRequestsResponse(
				__('bersiv-api-response::messages.failures.server_restriction'),
				$errors
			)
		)->send();
	}
}
