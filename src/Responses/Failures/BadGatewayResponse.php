<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 502 Bad Gateway responses.
 *
 * This response should be used when an external service rejects
 * a request or returns an invalid upstream response.
 */
class BadGatewayResponse extends FailureResponse
{
	/**
	 * Create a new bad gateway response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(string $message, array|JsonResource $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_BAD_GATEWAY, $message, $errors);
	}

	/**
	 * Return a response when the external API rejects the request.
	 *
	 * @param string|null $message Optional custom message.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function externalApiRejected(?string $message = null, array|JsonResource $errors = []): JsonResponse
	{
		return (
			new self(
				$message ?? __('bersiv-api-response::messages.failures.external_api_rejected'),
				$errors
			)
		)->send();
	}
}
