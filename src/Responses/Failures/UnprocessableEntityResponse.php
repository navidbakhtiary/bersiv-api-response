<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use NavidBakhtiary\BersivApiResponse\Helpers\Utilities;

/**
 * Represents HTTP 422 Unprocessable Entity responses.
 *
 * This response should be used when the request structure is valid,
 * but the provided input cannot be processed because it violates
 * validation or domain rules.
 */
class UnprocessableEntityResponse extends FailureResponse
{
	/**
	 * Create a new unprocessable entity response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(Response::HTTP_UNPROCESSABLE_ENTITY, $message, $errors);
	}

	/**
	 * Return a response for invalid attributes.
	 *
	 * @param array $attributes The invalid attribute names.
	 *
	 * @return \Illuminate\Http\JsonResponse The formatted JSON response.
	 */
	public static function invalidAttributes(array $attributes)
	{
		return (
			new self(
				__(
					'messages.failures.invalid_attributes',
					[
						'attributes' => Utilities::createStringFromArray($attributes),
					]
				)
			)
		)->send();
	}

	/**
	 * Return a response for invalid request inputs.
	 *
	 * @param string|null $message Optional custom validation message.
	 * @param array $errors Optional structured validation errors.
	 *
	 * @return \Illuminate\Http\JsonResponse The formatted JSON response.
	 */
	public static function invalidInputs(?string $message = null, array $errors = [])
	{
		return (
			new self(
				$message ?? __('bersiv-api-response::messages.failures.invalid_inputs'),
				$errors
			)
		)->send();
	}
}
