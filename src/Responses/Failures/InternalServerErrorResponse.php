<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 500 Internal Server Error responses.
 */
class InternalServerErrorResponse extends FailureResponse
{
	/**
	 * Create a new internal server error response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(string $message, array|JsonResource $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $message, $errors);
	}

	/**
	 * Return a default internal server error response.
	 *
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function serverError(array|JsonResource $errors = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::messages.failures.server_error'),
				$errors
			)
		)->send();
	}
}
