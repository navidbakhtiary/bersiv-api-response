<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

/**
 * Represents HTTP 429 Too Many Requests responses.
 */
class TooManyRequestsResponse extends FailureResponse
{
	/**
	 * Create a new too many requests response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_TOO_MANY_REQUESTS, $message, $errors);
	}

	/**
	 * Return a default too many requests response.
	 */
	public static function tooManyRequests()
	{
		return (new self(__('bersiv-api-response::messages.failures.server_restriction')))->send();
	}
}
