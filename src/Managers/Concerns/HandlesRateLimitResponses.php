<?php

namespace NavidBakhtiary\BersivApiResponse\Managers\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handles rate-limit-related facade responses.
 */
trait HandlesRateLimitResponses
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
		return $this->rate_limit_response_action->tooManyRequests($errors);
	}
}
