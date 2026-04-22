<?php

namespace NavidBakhtiary\BersivApiResponse\Actions\Validation;

use Illuminate\Http\JsonResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\ForbiddenResponse;
use NavidBakhtiary\BersivApiResponse\Responses\Failures\UnprocessableEntityResponse;

/**
 * Handles validation-related failure responses.
 *
 * This action is intended for cases where the request cannot be processed
 * because of invalid input, invalid attributes, or validation-like checks
 * such as captcha verification.
 *
 * Response behavior:
 * - returns 422 Unprocessable Entity for invalid inputs and attributes
 * - returns 403 Forbidden for invalid captcha, if captcha failure is treated
 *   as an access restriction in the application
 */
class ValidationResponseAction
{
	/**
	 * Return a response for invalid captcha verification.
	 *
	 * This is useful when the request is blocked because captcha validation
	 * did not pass.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidCaptcha(): JsonResponse
	{
		return ForbiddenResponse::invalidCaptcha();
	}

	/**
	 * Return a response for invalid attributes.
	 *
	 * This is useful when one or more requested attributes are not allowed
	 * or do not exist in the expected context.
	 *
	 * @param array $attributes The invalid attribute names.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidAttributes(array $attributes): JsonResponse
	{
		return UnprocessableEntityResponse::invalidAttributes($attributes);
	}

	/**
	 * Return a response for invalid request inputs.
	 *
	 * This is useful for general validation failures, malformed input,
	 * or request data that does not meet application rules.
	 *
	 * @param string|null $message Optional custom validation message.
	 * @param array $errors Optional structured validation errors.
	 *
	 * @return JsonResponse The formatted JSON response.
	 */
	public function invalidInputs(?string $message = null, array $errors = []): JsonResponse
	{
		return UnprocessableEntityResponse::invalidInputs($message, $errors);
	}
}
