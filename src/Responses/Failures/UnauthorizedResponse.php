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

	/**
	 * Return an unauthorized response for invalid login credentials.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function invalidLoginCredentials(array|JsonResource $errors = []): JsonResponse
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
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function unauthenticated(array|JsonResource $errors = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::auths.failures.invalid_token'),
				$errors
			)
		)->send();
	}
}
