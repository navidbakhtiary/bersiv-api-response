<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

/**
 * Represents HTTP 404 Not Found responses.
 */
class NotFoundResponse extends FailureResponse
{
	/**
	 * Create a new not found response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(JsonResponse::HTTP_NOT_FOUND, $message, $errors);
	}

	/**
	 * Return a default response for a missing resource.
	 *
	 * @param string $entity_name The missing resource name.
	 */
	public static function resourceNotFound(string $entity_name)
	{
		return (
			new self(
				__('bersiv-api-response::messages.failures.entity_not_found', ['entity' => $entity_name])
			)
		)->send();
	}
}
