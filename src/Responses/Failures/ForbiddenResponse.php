<?php

namespace NavidBakhtiary\BersivApiResponse\Responses\Failures;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * Represents HTTP 403 Forbidden responses.
 *
 * This response should be used when the request is understood
 * but the client is not allowed to proceed.
 */
class ForbiddenResponse extends FailureResponse
{
	/**
	 * Create a new forbidden response instance.
	 *
	 * @param string $message The response message.
	 * @param JsonResource|array $errors Optional structured error details.
	 */
	public function __construct(string $message, JsonResource|array $errors = [])
	{
		parent::__construct(Response::HTTP_FORBIDDEN, $message, $errors);
	}

	/**
	 * Return a response for invalid captcha verification.
	 *
	 * @return \Illuminate\Http\JsonResponse The formatted JSON response.
	 */
	public static function invalidCaptcha()
	{
		return (new self(__('bersiv-api-response::auths.failures.invalid_captcha')))->send();
	}
}
