<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

/**
 * Represents HTTP 401 Unauthorized responses.
 *
 * This response should be used when the client is unauthenticated
 * or provides invalid authentication credentials.
 */
class UnauthorizedResponse extends FailureResponse
{
	/**
	 * Create a new unauthorized response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(string $message, array|JsonResource $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_UNAUTHORIZED, $message, $errors);
	}
}
