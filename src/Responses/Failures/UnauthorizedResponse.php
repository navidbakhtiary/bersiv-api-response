<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

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
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(Response::HTTP_UNAUTHORIZED, $message, $errors);
	}

	/**
	 * Return an unauthorized response for invalid login credentials.
	 *
	 * @param JsonResource|array $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function invalidLoginCredentials(JsonResource|array $errors = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::auths.failures.incorrect_credentials'),
				$errors
			)
		)->send();
	}

	/**
	 * Return an unauthorized response for unauthenticated access.
	 *
	 * @param JsonResource|array $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function unauthenticated(JsonResource|array $errors = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::auths.failures.invalid_token'),
				$errors
			)
		)->send();
	}
}
