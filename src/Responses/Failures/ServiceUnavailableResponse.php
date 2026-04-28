<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 503 Service Unavailable responses.
 *
 * This response should be used when an upstream or external service
 * is temporarily unavailable or cannot be reached.
 */
class ServiceUnavailableResponse extends FailureResponse
{
	/**
	 * Create a new service unavailable response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(string $message, array|JsonResource $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_SERVICE_UNAVAILABLE, $message, $errors);
	}
}
