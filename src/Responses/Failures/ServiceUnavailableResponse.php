<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

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
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(Response::HTTP_SERVICE_UNAVAILABLE, $message, $errors);
	}

	/**
	 * Return a response for an unavailable external API.
	 *
	 * @return \Illuminate\Http\JsonResponse The formatted JSON response.
	 */
	public static function externalApiUnavailable()
	{
		return (new self(__('bersiv-api-response::messages.failures.unavailable_external_api')))->send();
	}
}
