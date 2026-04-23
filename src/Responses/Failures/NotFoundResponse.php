<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Represents HTTP 404 Not Found responses.
 */
class NotFoundResponse extends FailureResponse
{
	/**
	 * Create a new not found response instance.
	 *
	 * @param string $message The response message.
	 * @param array|JsonResource $errors Optional structured error details.
	 */
	public function __construct(string $message, array|JsonResource $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_NOT_FOUND, $message, $errors);
	}

	/**
	 * Return a default response for a missing resource.
	 *
	 * @param string $entity_name The missing resource name.
	 * @param array|JsonResource $errors Optional structured error details.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public static function resourceNotFound(string $entity_name, array|JsonResource $errors = []): JsonResponse
	{
		return (
			new self(
				__('bersiv-api-response::messages.failures.entity_not_found', ['entity' => $entity_name]),
				$errors
			)
		)->send();
	}
}
