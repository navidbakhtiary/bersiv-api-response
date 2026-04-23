<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

/**
 * Represents HTTP 500 Internal Server Error responses.
 */
class InternalServerErrorResponse extends FailureResponse
{
	/**
	 * Create a new internal server error response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $message, $errors);
	}

	/**
	 * Return a default internal server error response.
	 */
	public static function serverError()
	{
		return (new self(__('bersiv-api-response::messages.failures.server_error')))->send();
	}
}
